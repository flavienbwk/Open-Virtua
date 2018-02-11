
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Automatically deploy virtual machines on your Debian server with a single click via an attractive web interface.">
        <title><?= $Page->getTitle(); ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= $Page->renderURI("assets/css/app.css", true); ?>"/>
        <link rel="stylesheet" href="<?= $Page->renderURI("assets/css/main.css", true); ?>"/>
        <link rel="stylesheet" href="<?= $Page->renderURI("assets/css/doc_api.css", true); ?>"/>
    </head>

    <body>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?= $Page->renderURI("", true); ?>">Open Virtua</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $Page->renderURI("documentation/getting-started", true); ?>">Getting started</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $Page->renderURI("documentation/api", true); ?>">API</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/flavienbwk/Open-Virtua" target="_blank">Github</a>
                    </li>
                </ul>
            </div>
        </nav>