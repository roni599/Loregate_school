<template>
    <div class="container-fluid">
        <table v-for="teacher in teacherGalleryList" :key="teacher.id"
            class="table table-striped table-hover table-bordered">
            <tbody>
                <tr>
                    <td class="first-column">Teacher Name</td>
                    <td>{{ teacher.name }}</td>
                </tr>
                <tr>
                    <td class="first-column">Designation</td>
                    <td>{{ teacher.designation }}</td>
                </tr>
                <tr>
                    <td class="first-column">Mobile</td>
                    <td>{{ teacher.mobile }}</td>
                </tr>
                <tr>
                    <td class="first-column">E-Mail</td>
                    <td>{{ teacher.email }}</td>
                </tr>
                <tr>
                    <td class="first-column">Religion</td>
                    <td>{{ teacher.religion }}</td>
                </tr>
                <tr>
                    <td class="first-column">Picture</td>
                    <td><img :src="`/backend/images/teachergallery/${teacher.image}`" :alt="teacher.name" width="50"
                            height="50" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
export default {
    name: "TeachergalleryList",
    setup() {
        const currentComponent = ref(false);
        const teacherGalleryList = ref([]);
        const academy_id = ref(1)
        const fetchteacherGalleryData = async () => {
            try {
                const response = await axios.get(`/api/academy/teacher-gallery/${academy_id.value}`)
                if (response.data.data) {
                    teacherGalleryList.value = response.data.data;
                }
            } catch (error) {
                console.log(error)
            }
        }
        onMounted(() => {
            fetchteacherGalleryData();
        })
        return {
            currentComponent,
            fetchteacherGalleryData,
            teacherGalleryList,
            academy_id
        }
    }
}
</script>

<style scoped>
#searchInput {
    background-image: url("/backend/assets/img/searchicon.png");
    background-position: 10px 12px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
}

.full-width-modal {
    max-width: 100%;
    max-height: 100vh;
}

.full-width-modal .modal-content {
    width: 60%;
    height: 70vh;
    margin: auto;
}

.table_size {
    width: 100%;
    overflow: auto;
}
</style>