<template>
  <h1 class="text-6xl my-11 text-center">Reporte</h1>


  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">
          Lugar
        </th>
        <th scope="col" class="px-6 py-3 text-center">
          Reservaciones
        </th>
        <th scope="col" class="px-6 py-3">
          Likes
        </th>
        <th scope="col" class="px-6 py-3">
          Cliente preferido
        </th>
      </tr>
      </thead>
      <tbody>
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          v-for="item in info">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          <img :src=item.data.logo_img alt="" class="rounded-full w-20 h-20">
          {{ item.data.name }}
        </th>
        <td class="px-6 py-4 text-center">
          {{ item.num_reservations }}
        </td>
        <td class="px-6 py-4">
          {{ item.num_likes }}
        </td>
        <td class="px-6 py-4">
          {{ item.cliente_preferido }}
        </td>
      </tr>
      </tbody>
    </table>
  </div>


</template>


<script>
import axios from 'axios';

export default {
  data: () => ({
    info: null,
  }),
  name: 'List',

  mounted() {
    axios
        .get('/api/reservations')
        .then(response => {
              this.info = response.data
            }
        )
        .catch((error) => {
          console.log(error)
        })

  }
}
</script>