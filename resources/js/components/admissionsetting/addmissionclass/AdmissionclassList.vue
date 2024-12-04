<template>
  <div class="container-fluid">
    <table class="table table-striped table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">S.L</th>
          <th scope="col">Class</th>
          <th scope="col">Details</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(classItem, index) in classesData" :key="classItem.id">
          <td>{{ index + 1 }}</td>
          <td>{{ classItem.class_name }}</td>

          <td>
            {{ classItem.shift }}
            <span v-if="classItem.shift != null">/</span>
            {{ classItem.section }}
            <span v-if="classItem.section != null">/</span>
            {{ classItem.group }}
            <span v-if="classItem.group != null">/</span>
            {{ classItem.session }}
          </td>

          <td class="text-center">
            <input class="form-check-input" type="radio" :name="`status_${classItem.id}`" value="active"
              v-model="classItem.status" @change="updateStatus(classItem.id, 'active')" />
            <label class="form-check-label" for="active">Active</label>
            <input class="form-check-input ms-4" type="radio" :name="`status_${classItem.id}`" value="inactive"
              v-model="classItem.status" @change="updateStatus(classItem.id, 'inactive')" />
            <label class="form-check-label" for="inactive">Inactive</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
export default {
  name: "AdmissionclassList",
  setup() {
    const classesData = ref([]);
    const currentComponent = ref(false);
    const fetchData = async () => {
      try {
        const response = await axios.get(`/api/classes`);
        if (response.data && response.data.message) {
          classesData.value = response.data.data;
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    const updateStatus = async (classId, status) => {
      try {
        const response = await axios.post(`/api/classes/update-status/${classId}`, {
          status: status,
        });
        if (response.data && response.data.message) {
          Swal.fire({
            icon: "success",
            title: response.data.message,
          });
        }
      } catch (error) {

      }
    };
    onMounted(() => {
      fetchData();
    })
    return {
      currentComponent,
      fetchData,
      classesData,
      updateStatus,
    }
  }
}
</script>
<style scoped>
.text-center {
  text-align: center;
}
</style>