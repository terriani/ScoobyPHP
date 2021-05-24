{# View gerada automaticamente Via Scooby_CLI em dateNow #}
<div class="bg-login">
    <div class="container z-depth-5" style="margin:3% auto !important; padding:0; background-color: #ddd !important">
    <a href="{{ base_url }}back" class="btn white">{{ btn_back }}</a>
        <h2 class="center">Cosmos - Recuperação de senha</h2>
        {% if msg %}
            {{ msg|raw }}
        {% endif %}
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <form class="login-form  z-depth-5" method="post" action="{{ base_url }}password-reset">
                    <div class="card">
                        <input type="hidden" name="csrfToken" value="{{ csrfToken }}">
                        <input type="hidden" name="passwordToken" value='{{ token }}'>
                        <div class="card-content">
                            <div class="input-field col s12">
                                <input placeholder="Digite a nova senha" id='new-pass' name="new-password" type="password" class="validate">
                                <label for="new-pass">Nova Senha</label>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="input-field col s12">
                                        <input placeholder="Confirme a nova senha" id='confirm-pass' name="confirm-password" type="password"
                                            class="validate">
                                        <label for="confirm-pass">Confirme Nova Senha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Entrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col s4">
                        <a href="{{ base_url }}register" class="btn purple">{{ btn_sign_up }}</a>
                    </div>
                    <div class="col s8 right-align">
                        <a href="{{ base_url }}passwordRescue" class="btn red">{{ btn_password_reset }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
