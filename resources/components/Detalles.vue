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

  <div class="flex">
    <div class="w-3/4 p-4">

      <p class="font-bold text-3xl"><img class="rounded-full w-8 h-8" :src=info?.logo_img
                                         alt="image description">{{ info?.name }}</p>

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


</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    info: null,
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