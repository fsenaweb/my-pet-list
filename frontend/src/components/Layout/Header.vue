<template>
  <nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-gradient-blue mb-5">
    <div class="container">
      <a class="navbar-brand text-white" href="#">Teste Fullstack</a>
      <a class="nav-link nav-link-icon navbar-toggler" href="#">
        <i class="ni ni-button-power"></i>
      </a>
      <div class="collapse navbar-collapse" id="navbar-default">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler"
                      data-toggle="collapse" data-target="#navbar-default"
                      aria-controls="navbar-default" aria-expanded="false"
                      aria-label="Toggle navigation">
              </button>
            </div>
          </div>
        </div>

        <ul class="navbar-nav ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="#" @click.prevent="logout">
              <i class="ni ni-button-power"></i>
              <span class="nav-link-inner--text">Logoff</span>
            </a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
</template>

<script>
import api from '../../service/api';
import { logout } from '../../service/auth';

export default {
  methods: {
    logout() {
      api.post('/logout')
        .then(() => {
          logout();
          this.$router.push('/');
        });
    },
  },
};
</script>

<style scoped>

</style>
