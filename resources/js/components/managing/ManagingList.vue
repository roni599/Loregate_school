<template>
    <div class="container-fluid">
        <table v-for="managing in managingCummunityList" :key="managing.id"
            class="table table-striped table-hover table-bordered">
            <tbody>
                <tr>
                    <td class="first-column">Teacher Name</td>
                    <td>{{ managing.name }}</td>
                </tr>
                <tr>
                    <td class="first-column">Designation</td>
                    <td>{{ managing.designation }}</td>
                </tr>
                <tr>
                    <td class="first-column">Mobile</td>
                    <td>{{ managing.mobile }}</td>
                </tr>
                <tr>
                    <td class="first-column">E-Mail</td>
                    <td>{{ managing.email }}</td>
                </tr>
                <tr>
                    <td class="first-column">Religion</td>
                    <td>{{ managing.religion }}</td>
                </tr>
                <tr>
                    <td class="first-column">Picture</td>
                    <td><img :src="`/backend/images/managingcummunity/${managing.image}`" :alt="managing.name" width="50"
                            height="50" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
export default {
    name: "ManagingList",
    setup() {
        const currentComponent = ref(false);
        const managingCummunityList = ref([]);
        const academy_id = ref(1)

        const fetchManagingData = async () => {
            try {
                const response = await axios.get(`/api/academy/managingcummunity/${academy_id.value}`)
                if (response.data.data) {
                    managingCummunityList.value = response.data.data;
                }
            } catch (error) {
                console.log(error)
            }
        }
        onMounted(() => {
            fetchManagingData();
        })
        return {
            currentComponent,
            managingCummunityList,
            academy_id
        }
    }
}
</script>

<style scoped>
.first-column {
    width: 400px;
}

@media (max-width: 768px) {
    .first-column {
        width: 130px;
    }
}
</style>