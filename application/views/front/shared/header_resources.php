<?php 
//Attempt to fetch session variables:
$website = $this->config->item('website');
?>

<!-- START SHARED RESOURCES -->
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato|Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons|Titillium+Web:700" />
<link href="/css/lib/fa/fontawesome.css?v=5.10" rel="stylesheet" />
<link href="/css/lib/fa/brands.css?v=5.10" rel="stylesheet" />
<link href="/css/lib/fa/solid.css?v=5.10" rel="stylesheet" />
<link href="/css/lib/fa/light.css?v=5.10" rel="stylesheet" />

<!-- CSS -->
<link href="/css/lib/bootstrap.min.css" rel="stylesheet" />
<link href="/css/lib/animate.css" rel="stylesheet" />
<link href="/css/lib/jquery-ui.min.css" rel="stylesheet" />
<link href="/css/lib/default.min.css" rel="stylesheet" />
<link href="/css/lib/simplebar.css" rel="stylesheet" />
<link href="/css/console/material-dashboard.css?v=v<?= $website['version'] ?>" rel="stylesheet" />
<link href="/css/front/material-kit.css?v=v<?= $website['version'] ?>" rel="stylesheet" />
<link href="/css/front/styles.css?v=v<?= $website['version'] ?>" rel="stylesheet" />

<!-- Core JS Files -->
<script src="/js/console/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="/js/lib/jquery-ui.min.js" type="text/javascript"></script>
<script src="/js/console/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/console/material.min.js" type="text/javascript"></script>
<script src="/js/console/material-dashboard.js" type="text/javascript"></script>
<script src="/js/lib/jquery.countdownTimer.min.js" type="text/javascript"></script>
<script src="/js/lib/highlight.min.js"></script>
<script src="/js/lib/simplebar.js"></script>
<!-- END SHARED RESOURCES -->



<!-- Quora Pixel Code (JS Helper) -->
<script>
    !function(q,e,v,n,t,s){if(q.qp) return; n=q.qp=function(){n.qp?n.qp.apply(n,arguments):n.queue.push(arguments);}; n.queue=[];t=document.createElement(e);t.async=!0;t.src=v; s=document.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s);}(window, 'script', 'https://a.quora.com/qevents.js');
    qp('init', 'e2b1ee7285e84e2aad1cbfa286e2bbe3');
    qp('track', 'ViewContent');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://q.quora.com/_/ad/e2b1ee7285e84e2aad1cbfa286e2bbe3/pixel?tag=ViewContent&noscript=1"/></noscript>
<!-- End of Quora Pixel Code -->