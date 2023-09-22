<template>

  <div class="grid grid-cols-3 md:grid-cols-3 gap-3 my-5">
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700"
         v-for="item in info">

      <div class="flex justify-end m-4">
        <button class="rounded-full bg-gray-100 p-3" @click="addLike(item.id)"><i
            class="fa-regular fa-heart fa-2xl	"></i></button>
      </div>

      <router-link :to="'/detalle/' + item.id">
        <img class="rounded-t-lg w-full" :src=item.image_url alt=""/>
      </router-link>

      <div class="p-5">
        <router-link :to="'/detalle/' + item.id">
          <img class="rounded-full w-8 h-8" :src=item.logo_url alt="image description">
          <h6 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-blue-950">{{ item.name }}</h6>
        </router-link>
      </div>
      <div class="flex items-stretch  mt-5">
        <div class="text-center px-4">
          <i class="fa-solid fa-tags"></i> <span class="text-xs">{{ item.categories }}</span>
        </div>

        <div class="text-center px-4">
          <i class="fa-regular fa-clock"></i> <span class="text-xs">{{ item.schedule }}</span>
        </div>
      </div>

      <div class="flex items-stretch mt-5">
        <div class="text-center px-4">
          <i class="fa-solid fa-star"></i> <span class="text-xs">{{ item.score }}</span>
        </div>

        <div class="text-center px-4">
          <i class="fa-solid fa-money-bill"></i> <span class="text-xs">{{ item.price_range }}</span>
        </div>
        <div class="text-center px-4">
          <i class="fa-solid fa-location-dot"></i> <span class="text-xs">{{ item.location }}</span>
        </div>


      </div>


    </div>
  </div>

  <div class="flex justify-center mb-5">
    <button
        class="flex items-center justify-center px-4 h-10 mr-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        :class="this.page===1?'disabled:opacity-25':''"
        @click="previousPage()" :disabled="this.page===1"
    >
      <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13 5H1m0 0 4 4M1 5l4-4"/>
      </svg>
      Previous
    </button>
    <button
        class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        @click="nextPage()" :disabled="!showMore"
        :class="!showMore?'disabled:opacity-25':''"
    >
      Next
      <svg class=" w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9"/>
      </svg>
    </button>
  </div>

</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    info: null,
    page: 1,
    showMore: true
  }),
  name: 'List',
  methods: {
    nextPage() {
      this.page++;

      axios
          .get('/api/getPlacesByFilter', {
            params: {
              'mode': 'web',
              'page': this.page
            },
          })
          .then(response => {
            this.info = response.data.data
            this.showMore = response.data.showMore
          })
          .catch((error) => {
            console.log(error)
          })
    },

    previousPage() {
      this.page--;

      axios
          .get('/api/getPlacesByFilter', {
            params: {
              'mode': 'web',
              'page': this.page
            },
          })
          .then(response => {
            this.info = response.data.data
            this.showMore = response.data.showMore
          })
          .catch((error) => {
            console.log(error)
          })
    },

    addLike(id) {
      axios.post('api/likes', {
        'id': id
      }).then(response => {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: response.data.message,
          showConfirmButton: false,
          timer: 500
        })
      })
          .catch((error) => {
            console.log(error)
          })
    }

  },
  mounted() {
    axios
        .get('/api/getPlacesByFilter', {
          params: {
            'mode': 'web',
            'page': this.page
          },
        })
        .then(response => {
              this.info = response.data.data
              this.showMore = response.data.showMore
            }
        )
        .catch((error) => {
          console.log(error)
        })

  }
}
</script>