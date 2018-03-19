<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SaaS :: Server internal error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<h1>Service entry point error</h1>
<h2>Service configuration issue</h2>
<p>The following exception occurred at the SaaS MediaWiki entry point:</p>
<p style="font-weight: bold; color: darkred;"><?= $exception->getMessage() ?></p>
<h2>What I can do?</h2>
<h3>You're a visitor?</h3>
<p>This issue could be temporary and means the service is restarting. Try again in a few moment.</p>
<p>If this error persists, you can report this issue on IRC FreeNode #nasqueron-ops or our
    <a href="https://devcentral.nasqueron.org/maniphest/task/edit/form/4/">issue tracker</a><br />
    Include the text of the exception above.
</p>
<h3>You're maintainer?</h3>
<p>This application code is not a part of Mediawiki, but of the SaaS service calling it.<br />It can be found in the <a href="https://devcentral.nasqueron.org/source/saas-mediawiki/">saas-mediawiki</a> repository.</p>

</body>
</html>
