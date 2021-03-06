<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->output->enable_profiler(FALSE);

        cookie_check();

    }

    function index(){
        //App directory is a modal, redirect for now:
        $home_app = intval(get_domain_setting(14879));
        if($home_app){
            $this->load($home_app);
        } else {
            //Redirect to key idea:
            return redirect_message('/'.get_domain_setting(14002));
        }
    }


    function load($app_e__id = 14563 /* Error if none provided */){

        $memory_detected = is_array($this->config->item('n___6287')) && count($this->config->item('n___6287'));
        if(!$memory_detected){
            //Since we don't have the memory created we must load the app that does so:
            $app_e__id = 4527;
        }


        //Validate App
        if($memory_detected && !in_array($app_e__id, $this->config->item('n___6287'))){
            return redirect_message('/@'.$app_e__id, '<div class="msg alert alert-danger" role="alert">@'.$app_e__id.' Is not an APP, yet 🤫</div>');
        }


        //Run App
        boost_power();
        $member_e = false;
        $is_u_request = isset($_SERVER['SERVER_NAME']);

        if($memory_detected && $is_u_request){
            //Needs superpowers?
            $member_e = superpower_unlocked();
            $e___6287 = $this->config->item('e___6287'); //APP
            $superpower_actives = array_intersect($this->config->item('n___10957'), $e___6287[$app_e__id]['m__profile']);
            if($is_u_request && count($superpower_actives) && !superpower_active(end($superpower_actives), true)){
                die(view_unauthorized_message(end($superpower_actives)));
            }
        }

        $x__source = ( $is_u_request ? ( $member_e ? $member_e['e__id'] : 14068 /* GUEST */ ) : 7274 /* CRON JOB */ );


        //MEMBER REDIRECT?
        if($member_e && in_array($app_e__id, $this->config->item('n___14639'))){
            //Should redirect them:
            return redirect_message('/@'.$member_e['e__id']);
        } elseif(!$member_e && in_array($app_e__id, $this->config->item('n___14740'))){
            //Should redirect them:
            return redirect_message(home_url(), '<div class="msg alert alert-danger" role="alert"><span class="icon-block"><i class="fas fa-exclamation-circle"></i></span>App @'.$app_e__id.' is for members only</div>', true);
        }


        //Cache App?
        $title = null;
        $ui = null;
        $new_cache = false;
        $cache_x__id = 0;
        $cache_x__time = null;
        if($memory_detected){

            $e___6287 = $this->config->item('e___6287'); //APP
            $title = $e___6287[$app_e__id]['m__title'];

            if(in_array($app_e__id, $this->config->item('n___14599')) && !in_array($app_e__id, $this->config->item('n___12741'))){
                //Fetch Most Recent Cache:
                foreach($this->X_model->fetch(array(
                    'x__domain' => get_domain_setting(0),
                    'x__type' => 14599, //Cache App
                    'x__up' => $app_e__id,
                    'x__time >' => date("Y-m-d H:i:s", (time() - view_memory(6404,14599))),
                    'x__status IN (' . join(',', $this->config->item('n___7359')) . ')' => null, //PUBLIC
                ), array(), 1, 0, array('x__time' => 'DESC')) as $latest_cache){
                    $ui = $latest_cache['x__message'];
                    $cache_x__id = $latest_cache['x__id'];
                    $cache_x__time = '<div class="texttransparent center css__title">Updated ' . view_time_difference(strtotime($latest_cache['x__time'])) . ' Ago</div>';
                }
                if(!$ui){
                    //No recent cache found, create a new one:
                    $new_cache = true;
                }
            }
        }



        if(!$ui){

            //Prep view:
            $raw_app = $this->load->view('app/'.$app_e__id, array(
                'app_e__id' => $app_e__id,
                'x__source' => $x__source,
                'member_e' => $member_e,
                'is_u_request' => $is_u_request,
                'memory_detected' => $memory_detected,
            ), true);


            if($memory_detected && !in_array($app_e__id, $this->config->item('n___14597'))){
                $ui .= '<h1>' . $e___6287[$app_e__id]['m__title'] . '</h1>';
                //if(strlen($e___6287[$app_e__id]['m__message']) > 0){ $ui .= '<p class="msg">'.$e___6287[$app_e__id]['m__message'].'</p>'; }
            }
            $ui .= $raw_app;
        }


        if($new_cache){
            $cache_x = $this->X_model->create(array(
                'x__source' => $x__source,
                'x__type' => 14599, //Cache App
                'x__up' => $app_e__id,
                'x__message' => $ui,
            ));
            $cache_x__id = $cache_x['x__id'];
        }



        //Log App Load:
        $log_data = array(
            'x__source' => $x__source,
            'x__type' => 14067, //APP LOADED
            'x__up' => $app_e__id,
            'x__reference' => $cache_x__id,
            'x__metadata' => array(
                '$_GET' => $_GET,
                '$_POST' => $_POST,
            ),
        );

        //Append additional info for members:
        if($is_u_request){

            $log_data['x__message'] = current_link();

            //Any more data to append?
            if(isset($_GET['e__id'])){
                $es = $this->E_model->fetch(array(
                    'e__id' => $_GET['e__id'],
                    'e__type IN (' . join(',', $this->config->item('n___7358')) . ')' => null, //ACTIVE
                ));
                if(count($es)){
                    $log_data['x__down'] = $es[0]['e__id'];
                    $title = $es[0]['e__title'].' | '.$title;
                }
            }

            if(isset($_GET['i__id'])){
                $is = $this->I_model->fetch(array(
                    'i__id' => intval($_GET['i__id']),
                    'i__type IN (' . join(',', $this->config->item('n___7356')) . ')' => null, //ACTIVE
                ));
                if(count($is)){
                    $log_data['x__left'] = $is[0]['i__id'];
                    $title = $is[0]['i__title'].' | '.$title;
                }
            }
        }

        $x = $this->X_model->create($log_data);




        //Delivery App
        if(!$memory_detected){

            echo $ui;

        } else {

            if(in_array($app_e__id, $this->config->item('n___12741'))){

                //Raw UI:
                echo $raw_app;

            } else {

                $basic_header = intval(in_array($app_e__id, $this->config->item('n___14562')));

                //Regular UI:
                //Load App:
                echo $this->load->view('header', array(
                    'title' => $title,
                    'basic_header_footer' => $basic_header,
                ), true);
                echo $ui;
                echo $cache_x__time;
                echo $this->load->view('footer', array(
                    'basic_header_footer' => $basic_header,
                ), true);

            }
        }
    }



    function app_14709(){

        //Check all core variables:
        if (!isset($_POST['x__source']) || !isset($_POST['i__id']) || !isset($_POST['update_x__id']) || !isset($_POST['rating_e__id']) || !isset($_POST['feedback_text'])){
            return view_json(array(
                'status' => 0,
                'message' => 'Missing Starting Idea',
            ));
        }


        if(intval($_POST['update_x__id']) > 0){

            //Update:
            $this->X_model->update($_POST['update_x__id'], array(
                'x__up' => $_POST['rating_e__id'],
                'x__message' => $_POST['feedback_text'],
            ), $_POST['x__source'], 14733); //Update read Rating

        } else {

            //Create:
            $this->X_model->create(array(
                'x__source' => $_POST['x__source'],
                'x__type' => 14709, //RATE DISCOVERY
                'x__right' => $_POST['i__id'],
                //Feedback Info:
                'x__up' => $_POST['rating_e__id'],
                'x__message' => $_POST['feedback_text'],
            ));

        }

        //Return report:
        return view_json(array(
            'status' => 1,
        ));

    }




    function app_7264(){

        //Authenticate Member:
        $member_e = superpower_unlocked(12700);

        if (!$member_e) {
            return view_json(array(
                'status' => 0,
                'message' => view_unauthorized_message(12700),
            ));
        } elseif (!isset($_POST['i__id']) || intval($_POST['i__id']) < 1) {
            return view_json(array(
                'status' => 0,
                'message' => 'Missing Starting Idea',
            ));
        } elseif (!isset($_POST['depth_levels']) || intval($_POST['depth_levels']) < 1) {
            return view_json(array(
                'status' => 0,
                'message' => 'Missing Depth',
            ));
        }

        //Fetch/Validate idea:
        $is = $this->I_model->fetch(array(
            'i__id' => $_POST['i__id'],
            'i__type IN (' . join(',', $this->config->item('n___7356')) . ')' => null, //ACTIVE
        ));
        if(count($is) != 1){
            return view_json(array(
                'status' => 0,
                'message' => 'Could not find idea #'.$_POST['i__id'],
            ));
        }


        //Load AND/OR Ideas:
        $e___4737 = $this->config->item('e___4737'); // Idea Status


        //Return report:
        return view_json(array(
            'status' => 1,
            'message' => '<h3>'.$e___4737[$is[0]['i__type']]['m__cover'].' '.view_i_title($is[0]).'</h3>'.view_i_scores_answer($_POST['i__id'], $_POST['depth_levels'], $_POST['depth_levels'], $is[0]['i__type']),
        ));


    }



    function app_4341(){

        /*
         * Loads the list of transactions based on the
         * filters passed on.
         *
         * */

        $query_filters = unserialize($_POST['x_filters']);
        $joined_by = unserialize($_POST['x_joined_by']);
        $page_num = ( isset($_POST['page_num']) && intval($_POST['page_num'])>=2 ? intval($_POST['page_num']) : 1 );
        $next_page = ($page_num+1);
        $query_offset = (($page_num-1)*view_memory(6404,11064));
        $member_e = superpower_unlocked();

        $message = '';

        //Fetch transactions and total transaction counts:
        $x = $this->X_model->fetch($query_filters, $joined_by, view_memory(6404,11064), $query_offset);
        $x_count = $this->X_model->fetch($query_filters, $joined_by, 0, 0, array(), 'COUNT(x__id) as total_count');
        $total_items_loaded = ($query_offset+count($x));
        $has_more_x = ($x_count[0]['total_count'] > 0 && $total_items_loaded < $x_count[0]['total_count']);


        //Display filter:
        if($total_items_loaded > 0){

            //Subsequent messages:
            $message .= '<div class="css__title x-info grey">'.( $x_count[0]['total_count']>$total_items_loaded ? ( $has_more_x && $query_offset==0  ? 'FIRST ' : ($query_offset+1).' - ' ) . ( $total_items_loaded >= ($query_offset+1) ?  $total_items_loaded . ' OF ' : '' ) : '') . number_format($x_count[0]['total_count'] , 0) .' TRANSACTIONS:</div>';

        }


        if(count($x)>0){

            $message .= '<div class="list-group list-grey">';
            foreach($x as $x) {

                $message .= view_x($x);

                if($member_e && strlen($x['x__message'])>0 && strlen($_POST['x__message_search'])>0 && strlen($_POST['x__message_replace'])>0 && substr_count($x['x__message'], $_POST['x__message_search'])>0){

                    $new_content = str_replace($_POST['x__message_search'],trim($_POST['x__message_replace']),$x['x__message']);

                    $this->X_model->update($x['x__id'], array(
                        'x__message' => $new_content,
                    ), $member_e['e__id'], 12360, update_description($x['x__message'], $new_content));

                    $message .= '<div class="msg alert alert-info" role="alert"><i class="fas fa-check-circle"></i> Replaced ['.$_POST['x__message_search'].'] with ['.trim($_POST['x__message_replace']).']</div>';

                }

            }
            $message .= '</div>';

            //Do we have more to show?
            if($has_more_x){
                $message .= '<div id="x_page_'.$next_page.'"><a href="javascript:void(0);" style="margin:10px 0 72px 0;" class="btn btn-6255" onclick="app_4341(x_filters, x_joined_by, '.$next_page.');"><span class="icon-block"><i class="fas fa-search-plus"></i></span>Page '.$next_page.'</a></div>';
                $message .= '';
            } else {
                $message .= '<div style="margin:10px 0 72px 0;"><span class="icon-block"><i class="fas fa-check-circle"></i></span>All '.$x_count[0]['total_count'].' transactions have been loaded</div>';

            }

        } else {

            //Show no transaction warning:
            $message .= '<div class="msg alert alert-warning" role="alert"><span class="icon-block"><i class="fas fa-exclamation-circle"></i></span>No Transactions found with the selected filters. Modify filters and try again.</div>';

        }


        return view_json(array(
            'status' => 1,
            'message' => $message,
        ));


    }


    function load_index(){

        $member_e = superpower_unlocked(12699);
        if (!$member_e) {
            return view_json(array(
                'status' => 0,
                'message' => view_unauthorized_message(12699),
            ));
        }


        $ui = '<div class="row">';
        foreach (view_coins_e(12274, 6287, 1) as $app) {
            $ui .= view_e(6287, $app);
        }
        $ui .= '</div>';

        return view_json(array(
            'status' => 1,
            'load_index' => $ui,
        ));

    }

    function auth0_create($sign_i__id){

        //New account to be created:
        $member_result = $this->E_model->add_member(urldecode($_GET['name']), urldecode($_GET['email'])); //, urldecode($_GET['image_url'])
        if(!$member_result['status']) {
            $this->X_model->create(array(
                'x__type' => 4246, //Platform Bug Reports
                'x__message' => 'auth0_callback() Failed to create new member: '.$member_result['message'],
            ));
            die('Error creating a new account: '.$member_result['message']);
        }

        header('Location: '.new_member_redirect($member_result['e']['e__id'], $sign_i__id));

    }


}