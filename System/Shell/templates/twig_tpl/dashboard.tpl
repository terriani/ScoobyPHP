{# View gerada automaticamente Via Scooby_CLI em dateNow #}
{% if msg %}
{{ msg|raw }}
{% endif %}
<nav>
    <div class="nav-wrapper white">
        <div class="container">
            <a href="{{ base_url }}" class="brand-logo black-text"><strong>ScoobyPHP</strong></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text"><i class="material-icons">menu</i></a>
        </div>
        <ul class="right hide-on-med-and-down">
            <li class="black-text"><strong><u>Ola {{ userName }}</u></strong><i class="material-icons right">account_circle</i></li>
            &nbsp;&nbsp;&nbsp;
            <li><a href="{{ base_url }}alter-user" class="btn white black-text">Alterar</a></li>
            <li><a href="{{ base_url }}exit" class="btn grey darken-4">sair</a></li>
        </ul>
    </div>
</nav>
<ul class="sidenav" id="mobile-demo">
    <div class="center">
        <br><br>
        <h5>Ola {{ userName }} <i class="material-icons black-text">account_circle</i>
            <h5 />
    </div>
    <div class="divider"></div>
    <li><a href="{{ base_url }}alter-user">Alterar</a></li>
    <li><a href="{{ base_url }}exit">sair</a></li>
</ul>
<div class='container z-depth-5' style="margin:3% auto !important; padding:5%; background-color: #ddd !important">
    <h2 class="center">ScoobyPHP DashBoard.</h2>
    <h4 class='center'>Se você esta visualizando esta página, quer dizer que o sistema de login do ScoobyPHP funcionou
        corretamente!</h4>
    <br>
    <form action="{{ base_url }}delete-user" method="post">
        {{ method_delete|raw }}
        <input type="submit" class="btn red" value="{{ btn_delete }}">
    </form>
</div>