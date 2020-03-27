<template>
  <div>
    <my-header/>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <div class="form-group">
            <input type="search" v-model="search" class="form-control form" placeholder="Pesquisar">
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center mb-3">
          <thead class="thead-light">
          <tr>
            <th width="40%">
              <img src="../../assets/img/sort.png" width="13" @click="ordering('nome')"/> Pet
            </th>
            <th width="20%">
              Raça
            </th>
            <th width="30%">
              Criador
            </th>
            <th width="10%"></th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(pet, index) in listaPets" :key="index">
            <th scope="row">
              <div class="media align-items-center">
                <div class="media-body">
                  <span class="mb-0 text-sm">{{ pet.nome }}</span>
                </div>
              </div>
            </th>
            <td>
              {{ pet.especie.nome }}
            </td>
            <td>
              {{ pet.criador.nome }}
            </td>
            <td class="text-right">
              <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light"
                   href="#" role="button"
                   aria-haspopup="true" aria-expanded="false"
                   data-toggle="tooltip" data-placement="top" title="Visualizar Dados">
                  <i class="ni ni ni-folder-17"></i>
                </a>
                <a class="btn btn-sm btn-icon-only text-light"
                   href="#" role="button" @click.prevent="remove(pet.id)"
                   aria-haspopup="true" aria-expanded="false"
                   data-toggle="tooltip" data-placement="top" title="Excluir Dados">
                  <i class="ni ni ni-fat-remove"></i>
                </a>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center mb-5">
            <li class="page-item">
              <a class="page-link" href="#" @click.prevent="anterior">
                <i class="ni ni-bold-left"></i>
                <span class="sr-only">Anterior</span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#" @click.prevent="proximo">
                <i class="ni ni-bold-right"></i>
                <span class="sr-only">Próximo</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import api, { AuthService } from '../../service/api';
import MyHeader from '../Layout/Header.vue';

export default {
  data() {
    return {
      pets: [],
      search: '',
      sortBy: 'nome',
      sortByOrder: 'asc',
      perPage: 15,
      atualPage: 1,
    };
  },
  components: {
    MyHeader,
  },
  async mounted() {
    const user = await AuthService();
    if (!user) {
      this.$store.push('/login');
    }
    await api.get('/pets')
      .then((response) => {
        this.pets = response.data.data;
      })
      .catch(err => {
        console.log(err);
      });
  },
  computed: {
    listaPets() {
      if (this.search) {
        return this.pets.filter((res) => {
          res = Object.values(res);
          for (let i = 0; i < res.length; i++) {
            if ((res[i] + '').toLowerCase().indexOf(this.search.toLowerCase()) >= 0) {
              return true;
            }
          }
          return false;
        });
      }
      return this.pets.sort((a, b) => {
        let modifier = 1;
        if (this.sortByOrder === 'desc') modifier = -1;
        if (a[this.sortBy] < b[this.sortBy]) return -1 * modifier;
        if (a[this.sortBy] > b[this.sortBy]) return 1 * modifier;
        return 0;
      }).filter((row, index) => {
        const start = (this.atualPage - 1) * this.perPage;
        const end = this.atualPage * this.perPage;
        if (index >= start && index < end) return true;
      });
    },
  },
  methods: {
    remove(id) {
      this.$swal({
        title: 'Você deseja remover essas informações?',
        text: 'Você não poderá reverter essa ação!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: () => !this.$swal.isLoading(),
      }).then((result) => {
        if (result.value) {
          try {
            api.delete(`/pets/${id}`, {
              method: 'DELETE',
            })
              .then(() => {
                this.$swal({
                  title: 'Deu tudo certo!',
                  text: 'Dados excluídos com sucesso!',
                  type: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#125917',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK',
                });
              });
          } catch (err) {
            console.error(err);
          }
        }
      });
    },
    ordering(chave) {
      if (chave === this.sortBy) {
        this.sortByOrder = this.sortByOrder === 'asc' ? 'desc' : 'asc';
      }
      this.sortBy = chave;
    },
    proximo() {
      if ((this.atualPage * this.perPage) < this.pets.length) this.atualPage++;
    },
    anterior() {
      if (this.atualPage > 1) this.atualPage--;
    },
  },
};

</script>

<style scoped>
  .form {
    width: 20vw;
    position: relative;
    float: right;
  }

  @media screen and (max-width: 700px){
    .form {
      width: 93vw;
      position: relative;
      float: right;
    }
  }
</style>
