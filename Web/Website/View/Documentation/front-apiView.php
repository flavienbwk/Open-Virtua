<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Front-end API</h1>
            <p>A front-end REST API is available for the web interface so it can interact with the back-end.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="offset-lg-3 col-lg-6 offset-lg-3">
                    <div class="doc-parameters alert alert-secondary">
                        <br/>
                        <center>
                            <div class="general-parameter">
                                <span style="color:red;">EACH QUERY MUST INCLUDE THE <br/><b>X-Ov-Api-Key</b><br/> PARAMETER IN ITS <b>HEADER</b>.</span>
                                <p>This API key is set under <code>/Web/config.json</code>. Use it to register a new user only.</p>
                            </div>
                            <br>
                        </center>
                        <h4>JSON server response in any case :</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="parameter">error<span class="parameter-btw">|</span><span class="parameter-a">(boolean) true or false</span></span>
                            </li>
                            <li class="list-group-item"><span class="parameter">message<span class="parameter-btw">|</span><span class="parameter-a">(string) Details of the error if there's one.</span></span>
                            </li>
                            <li class="list-group-item"><span class="parameter">results<span class="parameter-btw">|</span><span class="parameter-a">(array) The "<b><i>Response</i></b>" of your query, detailed below.</span></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h4>Authentication routes</h4>
                        </div>
                        <div class="card-block">
                            <br/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                API Test
                                            </h4>
                                            <p>
                                                Check your API key and connection to the server with this route.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-get">
                                            GET
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_api_test" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_api_test" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">None
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a"></span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_api_test"><i>Response :</i></a>
                                            <div id="response_api_test" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre><i>(nothing)</i></pre></td>
                                                            <td><pre></pre></td>
                                                            <td>If the API is available and your API key is valid, the "error" response will be set to <code>false</code>.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Login
                                            </h4>
                                            <p>
                                                Receive an authorization token for someone's login and password.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/login
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_api_login" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_api_login" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">username
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The username of the user.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">password
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The password of the user.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_api_login"><i>Response :</i></a>
                                            <div id="response_api_login" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>user_id</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The ID of the user you will have to use for your user operations.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>token_id</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The token ID you will have to use for your user operations.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>expiration</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>UNIX timestamp at which the token expires.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Login token check
                                            </h4>
                                            <p>
                                                Check your token ID validity so you can know if you have to re-ask for a token if you've lost the "expiration" date.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/login/check
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_api_login_check" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_api_login_check" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The username of the user.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the user.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_api_login_check"><i>Response :</i></a>
                                            <div id="response_api_login_check" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>expiration</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>The date of expiration of the token. If the token is valid, the "error" response will be set to <code>false</code>.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Register
                                            </h4>
                                            <p>
                                                Register a user with several information given.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/register
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_api_register" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_api_register" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">username
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The username of the user.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">password
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The password of the user (>= 4 characters).</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">email
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">(optional) Email address of the user.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">phonenumber
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">(optional) Phone number of the user in the international format.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_api_register"><i>Response :</i></a>
                                            <div id="response_api_register" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>username</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The user name.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h4>Master servers routes</h4>
                        </div>
                        <div class="card-block">
                            <br/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Master servers list
                                            </h4>
                                            <p>
                                                Get the list of all the master servers owned from one user.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/master/list
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_master_list" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_master_list" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user detaining the master server(s).</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_master_list"><i>Response :</i></a>
                                            <div id="response_master_list" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>list</pre></td>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td>
                                                                <pre>[
 "master_id": (string),
 "name": (string),
 "ip": (string)
]</pre>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Add a master server
                                            </h4>
                                            <p>
                                                Add a server on which will run the VMs. Open Virtua will access this "master" server through a SSH connection.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/master/add
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_master_add" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_master_add" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user to which is provided the server.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">name
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">Name of the server.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">ip
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">IP to which connect to the master server (can be local).</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">ssh_port
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">(optional, default=22) As Open Virtua connects your master machine through SSH, please enable it on your machine.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">username
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The username of the user.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">password
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The password of the user.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_master_add"><i>Response :</i></a>
                                            <div id="response_master_add" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>master_id</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The ID of the master server created.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Master server details
                                            </h4>
                                            <p>
                                                Get the details of one master server.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/master/details
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_master_details" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_master_details" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user to which is provided the server.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master server created.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_master_details"><i>Response :</i></a>
                                            <div id="response_master_details" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>master_id</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The ID of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>user_id</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>ID of the user to which is provided the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>name</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The name of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>ip</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The IP of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>memory</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>The total memory (RAM) in Mo of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>storage</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>The total storage in Mo of the server.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Update master server
                                            </h4>
                                            <p>
                                                Update a master machine in the database.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/master/update
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_master_update" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_master_update" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user detaining the master server(s).</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master server created.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">remove
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a"><i>(Optional)</i> <b>1</b> or <b>0</b> (0 is default). Remove this master and the VM associated with it (from our database only, not physically).</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">ssh_port
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a"><i>(Optional)</i> The SSH port to modify.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">username
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a"><i>(Optional)</i> The username to modify.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">password
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a"><i>(Optional)</i> The password to modify.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_master_update"><i>Response :</i></a>
                                            <div id="response_master_update" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre><i>(nothing)</i></pre></td>
                                                            <td><pre></pre></td>
                                                            <td>If the update has succeeded, the "error" response will be set to <code>false</code>.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h4>Slave / VM servers routes</h4>
                            <p>Some routes to run your VMs on your master server.</p>
                        </div>
                        <div class="card-block">
                            <br/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Slave servers list
                                            </h4>
                                            <p>
                                                Get the list of all the slave servers of a master.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/slave/list
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_slave_list" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_slave_list" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user detaining the slave server(s).</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master machine on which are hosted the slaves (VMs).</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_slave_list"><i>Response :</i></a>
                                            <div id="response_slave_list" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>list</pre></td>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td>
                                                                <pre>[
 "slave_id": (string),
 "name": (string),
 "ip": (string),
 "ssh_port": (int)
]</pre>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Create a slave server
                                            </h4>
                                            <p>
                                                Create a slave (virtual machine) on your master server.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/slave/create
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_slave_add" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_slave_add" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user to which is provided the server.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master machine on which this VM (slave) will be created.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">hypervisor_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the hypervisor with which will be built the VM (see the section relative to hypervisors to get the list).</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">distribution_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the distribution to install on the VM (see the section relative to distributions to get the list).</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">name
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">Name of the server.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">username
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The username of the user.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">password
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The password of the user.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">memory
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The quantity of memory for your VM in Mo. Must be lesser than the master server total memory.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">storage
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The quantity of storage for your VM in Mo. Must be lesser than the master server total storage.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_slave_add"><i>Response :</i></a>
                                            <div id="response_slave_add" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>master_id</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The ID of the master server created.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Slave server details
                                            </h4>
                                            <p>
                                                Get the details of one slave server.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/slave/details
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_slave_details" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_slave_details" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user to which is provided the server.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">slave_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the slave server.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master machine on which is hosted the slave.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_slave_details"><i>Response :</i></a>
                                            <div id="response_slave_details" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>hypervisor_name</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The name of the hypervisor executed on this VM.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>distribution_name</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The name of the distribution executed on this VM.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>name</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The name of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>ip</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The IP of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>ssh_port</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>The SSH port of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>mac</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The MAC address of the server..</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>gateway</pre></td>
                                                            <td><pre><i>(string)</i></pre></td>
                                                            <td>The gateway of the server.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>memory</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>The total memory (RAM) in Mo of the VM.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>storage</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>The total storage in Mo of the VM.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>date</pre></td>
                                                            <td><pre><i>(int)</i></pre></td>
                                                            <td>UNIX timestamp for which the VM has been created.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Slave command
                                            </h4>
                                            <p>
                                                Send a command to your slave and get its output.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/slave/command
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_slave_command" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_slave_command" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">slave_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the slave server to send the command to.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master machine on which is hosted the slave.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">command
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The command you want to send to the slave.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_slave_command"><i>Response :</i></a>
                                            <div id="response_slave_command" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>output</pre></td>
                                                            <td><pre><i>(numeric array)</i></pre></td>
                                                            <td>
                                                                <pre>[]</pre>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Slave preseeds list
                                            </h4>
                                            <p>
                                                Get the list of the preseeds for a special slave.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/slave/preseeds
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_slave_preseeds" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_slave_preseeds" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">slave_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the slave server to send the command to.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master machine on which is hosted the slave.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_slave_preseeds"><i>Response :</i></a>
                                            <div id="response_slave_preseeds" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>list</pre></td>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td>
                                                                <pre>[
 "preseed_id": (int),
 "execution_order": (int),
 "executed": (int) (1 = already executed or 0 = not executed yet )
]</pre>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Add a preseed to a slave
                                            </h4>
                                            <p>
                                                Add a preseed to your VM slave. In the order you want.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/slave/preseeds/add
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_preseed_slave_add" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_preseed_slave_add" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">preseed_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the preseed you want to add to the slave.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">slave_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the slave you want to add the preseed to.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master machine on which is hosted the slave.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">execution_order
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">(int) The order of execution of this preseed for the slave VM you want. Will be executed, in order, during the installation.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_preseed_slave_add"><i>Response :</i></a>
                                            <div id="response_preseed_slave_add" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre><i>(nothing)</i></pre></td>
                                                            <td><pre></pre></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Remove a preseed from a slave
                                            </h4>
                                            <p>
                                                Remove a preseed from your VM slave.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/slave/preseeds/remove
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_preseed_slave_remove" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_preseed_slave_remove" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">preseed_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the preseed you want to add to the slave.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">slave_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the slave you want to remove the preseed from.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">master_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the master on which is created the slave.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_preseed_slave_remove"><i>Response :</i></a>
                                            <div id="response_preseed_slave_remove" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td><pre></pre></td>
                                                            <td>If the query succeed, you will get the "error" key to "false", as usual.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h4>Distributions & Hypervisors</h4>
                            <p>Hypervisors are the technologies used to run your virtual machines. Distributions are the OS that run on your VMs.</p>
                        </div>
                        <div class="card-block">
                            <br/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Hypervisors list
                                            </h4>
                                            <p>
                                                Get the list of all the hypervisors stored in the database.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/hypervisor/list
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_hypervisor_list" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_hypervisor_list" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_hypervisor_list"><i>Response :</i></a>
                                            <div id="response_hypervisor_list" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>list</pre></td>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td>
                                                                <pre>[
 "hypervisor_id": (string),
 "name": (string),
 "description": (string),
 "pxe_eligible": (int (1 = true or 0 = false))
 "available": (int (1 = true or 0 = false))
]</pre>
                                                                <p><code>pxe_eligible</code> allows to know if the hypervisor can work with a PXE system.</p>
                                                                <p><code>available</code> allows to know if the hypervisor is supported or not by Open Virtua yet.</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Distributions for hypervisor
                                            </h4>
                                            <p>
                                                Get the list of all the distributions available for a special Hypervisor.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/hypervisor/distributions
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_hypervisor_distribs_list" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_hypervisor_distribs_list" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">hypervisor_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the hypervisor for which you want to list the available distributions.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_hypervisor_distribs_list"><i>Response :</i></a>
                                            <div id="response_hypervisor_distribs_list" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>list</pre></td>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td>
                                                                <pre>[
 "distribution_id": (string),
 "distribution_name": (string),
 "distribution_description": (string)
]</pre>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Preseeds list for distribution
                                            </h4>
                                            <p>
                                                Get the list of all the preseeds available for a distribution.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/distribution/preseeds
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_distribs_preseeds_list" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_distribs_preseeds_list" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">distribution_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the distribution for which you want to get the list for the preseeds available.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_distribs_preseeds_list"><i>Response :</i></a>
                                            <div id="response_distribs_preseeds_list" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>list</pre></td>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td>
                                                                <pre>[
 "preseed_id": (string),
 "name": (string),
 "script": (string),
 "archive_status": (int (0 = not downloaded, 1 = downloaded))
]</pre>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Create a preseed
                                            </h4>
                                            <p>
                                                A script which will be executed at the first launch of a Slave (VM). We allow you to create a custom preseed.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/preseed/create
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_preseed_create" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_preseed_create" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">distribution_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the distribution for which the preseed will be authorized to be executed. You will have to attribute the preseed for the VM you want.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">name
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">Name of your preseed.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">script
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">Your shell script to execute (bash).</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_preseed_create"><i>Response :</i></a>
                                            <div id="response_preseed_create" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre>list</pre></td>
                                                            <td><pre><i>(array)</i></pre></td>
                                                            <td>
                                                                <pre>[
 "preseed_id": (string),
 "name": (string)
]
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="doc-container">
                                        <div class="doc-title">
                                            <h4>
                                                Remove a preseed
                                            </h4>
                                            <p>
                                                Remove an existant preseed for one distribution.
                                            </p>
                                            <hr>
                                        </div>
                                        <div class="doc-method-post">
                                            POST
                                        </div>
                                        <div class="doc-url">
                                            <p>
                                                /api/preseed/remove
                                            </p>
                                        </div>
                                        <div class="panel-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <br>
                                                    <a data-toggle="collapse" href="#parameters_preseeds_remove" class="" aria-expanded="true"><i>Parameters :</i></a>
                                                </div>
                                                <div id="parameters_preseeds_remove" class="panel-collapse doc-parameters collapse in" aria-expanded="true" style="">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <span class="parameter">token_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The login token.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">user_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">ID of the user logged in.</span>
                                                            </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="parameter">preseed_id
                                                                <span class="parameter-btw">|</span>
                                                                <span class="parameter-a">The ID of the preseed to remove.</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-parameters">
                                            <a data-toggle="collapse" href="#response_preseeds_remove"><i>Response :</i></a>
                                            <div id="response_preseeds_remove" class="panel-collapse collapse doc-parameters">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <tbody>
                                                        <tr>
                                                            <th>Index</th>
                                                            <th>Return value</th>
                                                            <th>Description</th>
                                                        </tr>
                                                        <tr>
                                                            <td><pre><i>(nothing)</i></pre></td>
                                                            <td><pre></pre></td>
                                                            <td>Returns "error" = false if succeeded.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</main>
