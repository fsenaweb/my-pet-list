<template>
  <div class="bg-default">
    <div class="header bg-gradient-primary py-1 py-lg-7">
      <div class="d-block d-md-block d-lg-none" style="margin-top: 180px">
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
             xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <div class="container mt--7 pb-5" :style="{height: altura}">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4 mt-3">
                <p><img src="./../../assets/img/logo.png" alt="Logomarca" width="140"></p>
                <small>Entre com o seu login e senha cadastrados.</small>
              </div>
              <form method="POST" @submit.prevent="handleSubmit()">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="ni ni-email-83"></i>
                        </span>
                    </div>
                    <input
                      class="form-control"
                      placeholder="E-mail" type="email"
                      name="email"
                      v-model="email"
                      required autoFocus/>
                  </div>
                </div>
                <div
                  class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="ni ni-lock-circle-open"></i>
                      </span>
                    </div>
                    <input
                      class="form-control"
                      name="password"
                      placeholder="Senha"
                      type="password"
                      v-model="password"
                      required/>
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox mt-2">
                  <input class="custom-control-input" name="remember"
                         id="customCheckLogin"
                         type="checkbox"/>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Entrar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer/>
  </div>
</template>

<script>
import axios from 'axios';
import { isAuthenticated, login } from '../../service/auth';

export default {
  data() {
    return {
      altura: 'calc(100vh - 100px)',
      email: '',
      password: '',
      show: false,
    };
  },
  mounted() {
    if (isAuthenticated()) {
      this.$router.push('/painel');
    }
  },
  methods: {
    handleSubmit() {
      const data = {
        email: this.email,
        password: this.password,
      };
      axios.post(`${process.env.VUE_APP_URL_API}/login`, data)
        .then((response) => {
          login(response.data.token);
          this.$router.push('/painel');
        })
        .catch((er) => {
          console.log(er)
          this.$swal({
            type: 'error',
            title: 'Login e/ou senha inválido!',
            showConfirmButton: true,
          });
        });
    },
  },
};

</script>

<style scoped>

</style>
