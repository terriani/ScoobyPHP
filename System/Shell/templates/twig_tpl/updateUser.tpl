{# View gerada automaticamente Via Scooby_CLI em dateNow #}
<div class="container bg-login z-depth-5" style="margin:3% auto !important; padding:0; background-color: #ddd !important">
    <a href="{{ base_url }}back" class="btn black">{{ btn_back }}</a>
        <h3 class="center">Cosmos - Atualizar Usuário</h3>
        {% if msg %}
            {{ msg|raw }}
        {% endif %}
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <form class="login-form  z-depth-5" method="post" action="{{ base_url }}update-user">
                    {{ method_put|raw }}
                    <div class="card">
                        <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                        <div class="card-content">
                            <div class="input-field">
                                <input class="validate" id="name" type="text" name="name" value='{{ name }}'>
                                <label for="name">Nome</label>
                            </div>
                            <div class="input-field">
                                <input class="validate" id="email" type="email" name="email" value='{{ email }}'>
                                <label for="email">Email</label>
                            </div>

                            <div class="row">
                                <div class="col s12 m8 l12">
                                    <div class="input-field">
                                        <input id="password" type="password" name="pass">
                                        <label for="password">Senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">{{ btn_update }}
                                    <i class="material-icons right">send</i>
                                </button> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>