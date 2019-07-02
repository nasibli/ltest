<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel test</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <main role="main" class="container" id="app">

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 10px">
                <a class="navbar-brand" href="#">Ltest</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'users' }">Users</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'departments' }">Departments</router-link>
                        </li>
                    </ul>
                    <div class="btn-group">
                        <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @{{ user.name }} (@{{  user.email }})
                        </button>
                        <div class="dropdown-menu">
                            <a v-on:click="logout" class="dropdown-item" href="#">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div >
                <router-view></router-view>
            </div>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js" charset="utf-8"></script>
        <script src="https://unpkg.com/vuetable-2@1.6.0"></script>
        <script type="text/javascript" src="/app.js"></script>
    </body>
</html>
