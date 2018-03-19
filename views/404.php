<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SaaS :: Instance not found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<h1>Service not found</h1>
<p>The <?= $this->getHost() ?> instance of your service is not available.</p>
<p>This generally means the domain name has been configured to point to
    this server, but is not declared in the configuration.</p>
<h2>Is this a new wiki?</h2>
<p>This entry point serves several wikis. If you're creating a new wiki, this message means
    you've successfully configured the DNS and the front-end web server.</p>
<h3>What should I do now?</h3>
<p>The next step is to declare your wiki to the <strong>saas-mediawiki</strong> repository.</p>
<p>Create the wiki database if still not done and
    declare the host / database pair to the <kbd>config/Instances.php</kbd> file.</p>
<p>This repository is also where you can customize the wiki settings,
in the <kbd>config/Settings.php</kbd> file.<br />You probably want to customize site name there.</p>
<p>You've done all those steps? Reload php-fpm to reset caching or troubleshoot those files.</p>

</body>
</html>
