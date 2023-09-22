<template>

  <nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
      <li class="inline-flex items-center">
        <a href="/"
           class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
          <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
               viewBox="0 0 20 20">
            <path
                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
          </svg>
          Inicio
        </a>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4"/>
          </svg>
          <a href="#"
             class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
            {{ info?.name }}
          </a>
        </div>
      </li>
    </ol>
  </nav>

  <swiper
      :slidesPerView="4"
      :spaceBetween="30"
      :autoplay="{
          delay: 2500
      }"
      :pagination="{
      loop: true,
    }

"
      :modules="modules"
      class="mySwiper"
  >
    <swiper-slide v-for="item in info?.gallery">
      <img :src=item?.file alt="">
    </swiper-slide>
  </swiper>

  <div class="flex">

    <div class="w-3/4 p-4">

      <p class="font-bold text-3xl"><img class="rounded-full w-8 h-8" :src=info?.logo_img
                                         alt="image description">{{ info?.name }}</p>

      <button type="button" @click="reservar=true;"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Reservar
      </button>


      <form class="my-10" v-if="reservar" @submit.prevent=false>


        <div class="grid md:grid-cols-2 md:gap-6">
          <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="nombre" id="nombre" v-model="dataReserva.name"
                   class="block py-2.5 px-0 w-full text-sm text-blue-950 bg-transparent border-0 border-b-2 border-gray-300  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder="" required/>
            <label for="nombre"
                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
              Nombre</label>
          </div>
          <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="floating_last_name" id="floating_last_name" v-model="dataReserva.last_names"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder=" " required/>
            <label for="floating_last_name"
                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
              Apellidos</label>
          </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">

          <div class="relative z-0 w-full mb-6 group">
            <label for="fecha"
                   class="">
              Fecha</label><br>
            <input type="date" name="floating_last_name" id="floating_last_name" v-model="dataReserva.fecha"
                   class=" "
                   placeholder=" " required/>


          </div>


          <div class="relative z-0 w-full mb-6 group">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">Hora</label>
            <select id="countries" v-model="dataReserva.hora"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
              <option v-for="item in info?.reservations[0].data.hours">{{ item }}</option>
            </select>
          </div>
        </div>

        <button type="submit" @click="store()"
                class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Submit
        </button>
      </form>


      <h2 class="text-xl font-bold my-3">Descripción</h2>

      <div v-html=info?.schema.description class="font-light"></div>

      <h2 class="text-xl font-bold my-3 ">Galería</h2>


      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div v-for="item in info?.gallery">
          <img class="rounded-lg h-auto max-w-xs transition-all duration-300 blur-sm hover:blur-none"
               :src="item.file" alt="">
        </div>

      </div>


    </div>
    <div class="w-1/4 p-4">
      <p class="font-bold text-xl">Detalles</p>
      <i class="profile-map-address-icon fa fa-map-marker-alt" aria-hidden="true"></i>
      <span class="text-xl font-bold">
        ¿Cómo llegar?
      </span>
      <div class="">
        <img :src="imageMap" alt="imageMap">
        <div class="profile-map-address">
          {{ info?.geolocation?.text_direction }}
        </div>
      </div>
      <h4 class="text-xl font-bold my-3">
        <i class="fa-regular fa-clock reservation-color-icons mr-1"></i>
        Horarios
      </h4>
      <ul id="example-1">
        <li v-for="item in info?.schedules">
          {{ item.weekday }} <span class="font-bold">{{ item.start }} - {{ item.end }}</span>
        </li>
      </ul>

      <h4 class="text-xl font-bold my-3">
        <i class="fa-solid fa-grip reservation-color-icons mr-1"></i>
        Amenidades
      </h4>

      <ul id="example-2">
        <li v-for="item in info?.amenities">
          {{ item.name }}
        </li>
      </ul>

      <h4 class="text-xl font-bold my-3">
        <i class="fa-solid fa-tags reservation-color-icons mr-1"></i>
        Categorías
      </h4>

      <ul id="example-3">
        <li v-for="item in info?.categories">
          {{ item.name }}
        </li>
      </ul>


    </div>

  </div>

  <h4 class="text-xl font-bold my-3">
    Cerca de ti
  </h4>


  <div class="grid grid-cols-5 gap-4">
    <div v-for="item in info?.closer_places">
      <img class="max-h-50 max-w-50 rounded-lg" :src=item.img_url alt="">
      <p class="font-bold ">{{ item.name }}</p>
      <p class="font-light"><i class="fa fa-map-marker-alt" aria-hidden="true"></i> {{ item.address }}</p>
    </div>


  </div>


</template>

<script>
import axios from 'axios';
import {Swiper, SwiperSlide} from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

import 'swiper/css/pagination';


// import required modules
import {Pagination} from 'swiper/modules';


export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
    return {
      modules: [Pagination],
    };
  },
  methods: {
    store() {
      this.dataReserva.id_place = this.getId()
      axios.post('/api/reservations', this.dataReserva)
          .then(response => {
                let {status, message} = response.data
                let icon = status ? 'success' : 'error';

                Swal.fire({
                  position: 'top-end',
                  icon: icon,
                  title: message,
                  showConfirmButton: false,
                  timer: 1000
                });

                if (status) {
                  this.dataReserva = {
                    id_place: '',
                    name: '',
                    last_names: '',
                    fecha: '',
                    hora: ''
                  }
                }

              }
          )
          .catch((error) => {
            console.log(error)
          })
    },

    getId() {
      return this.$route.params.id;
    }
  },

  data: () => ({
    info: null,
    reservar: false,
    dataReserva: {
      id_place: '',
      name: '',
      last_names: '',
      fecha: '',
      hora: ''
    },
    imageMap: 'http://127.0.0.1:8000/map.jpeg'
  }),
  name: 'detalle',
  mounted() {
    axios
        .get('/api/getPlaceById/' + this.$route.params.id)
        .then(response => {
              this.info = response.data.data
            }
        )
        .catch((error) => {
          console.log(error)
        })

  }
}
</script>