<?php
$title = "Sign in";
include("scripts/includes/header.php") ?>


<main>
    <section class="todo" id="auth">
		<?php if(isset($_SESSION['logged_user'])): header("Location: ./"); else: ?>
		<div class="sign-up">
			<h1 class="sign-up__title text-center">Авторизация</h1>
			<form class="todo__reg-form text-center" id="signUpForm" @submit.prevent="reg()">
				<div class="input-group">
					<input type="text" class="input-group__input" placeholder="Логин" v-model="login">
				</div>
				<div class="input-group">
					<input type="password" class="input-group__input" placeholder="Пароль" v-model="pass">
				</div>
				<button type="submit" class="todo__add-btn">Войти</button>
                <p v-if="response.data " class="help">{{ response.data }}</p>
				<div class="sign-up-link">Еще не с нами? <a href="<?php echo SITEURL; ?>/sign-up.php"> Зарегистрируйтесь!</a> </div>	
			</form>
		</div>
		<?php endif; ?>
	</section>
</main>

<?php
include("scripts/includes/footer.php"); ?>
<script>
    new Vue({
        el: "#auth",
        data:{
            login: '',
            pass: '',
            response: ''
        },
        methods: {
            reg: function(){
                axios
                    .get('scripts/sign-up/do_sign_in.php?login='+this.login+'&pass='+this.pass)
                    .then(response=>{
                        this.response=response;
                        if(this.response.data=="OK"){
                            window.location.replace("./");
                        }
                    })
                    .catch(error=>console.log(error.data));
            }
        }
    });
</script>
