{# View gerada automaticamente Via Scooby_CLI em dateNow #}
    <div class="navbar-fixed">
        <nav class="z-depth-0">
            <div class="nav-wrapper white">
                <a href="#" class="brand-logo center black-text"> ScoobyPHP <img  src="{{ assets }}img/scooby_logo.svg" alt="Foto de uma pessoa relaxando na praia" height="50" style="position: relative; top: 15px">
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="{{ base_url }}login" class="black-text waves-light">{{ btn_sign_in }}</a></li>
                    <li><a href="{{ base_url }}register" class="btn grey darken-4 waves-light white-text">{{ btn_sign_up }}</a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="{{ base_url }}login" class="btn green waves-light black-text">{{ btn_sign_in }}</a></li>
        </ul>
    </div>
    <div id="home">
    <div class="container">
        <div class="home">
            <img class="relax-img" src="{{ assets }}img/scooby_logo.svg" alt="Foto de uma pessoa relaxando na praia">
            <h2 class="center">
                <b>ScoobY Framework</b>
            </h2>
            <h3>
                {{ wellcomeMessage }}
            </h3>
            <footer class="">
                <span class="right footer-msg"> Feito em <i class="green-text"><strong>PG</strong></i> com muito <i
                        class="material-icons right red-text">favorite</img></span>
            </footer>
        </div>
    </div>
</div>