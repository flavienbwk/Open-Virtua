<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h1 class="display-3">Getting started</h1>
                <p>Manual of installation of Open Virtua.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <center>
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h2>1. Download Open Virtua :</h2>
                        </div>
                        <div class="card-body">
                            <p>Download Open Virtua from Github and place you inside the directory.</p>
                            <hr/>
                            <pre>git clone https://github.com/flavienbwk/Open-Virtua</pre>
                            <pre>cd Open-Virtua/</pre>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>2. Install the API :</h2>
                        </div>
                        <div class="card-body">
                            <p>Get guided through the installation process with a single script to execute.</p>
                            <hr/>
                            <pre>bash ./install.sh</pre>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>3. Configure the API :</h2>
                        </div>
                        <div class="card-body">
                            <p>Change the MySQL database information (host, username and password) in a single file.</p>
                            <hr/>
                            <pre>nano /var/www/openvirtua/Web/config.json</pre>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>4. Install the Ionic web interface :</h2>
                        </div>
                        <div class="card-body">
                            <p>Now install the Ionic web interface so you can get your website as well on your phone.</p>
                            <hr/>
                            <i>Inside the App/ directory.</i>
                            <pre>npm install</pre>
                            <pre>ionic serve</pre>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
</div>
<br/>