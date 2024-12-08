<template>
    <div class="container">
        <div class="card mb-4 mt-3">
            <div class="card-header d-flex justify-content-between">
                <div class="employee_table">
                    <i class="fas fa-table me-1"></i> Users Table
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <th>{{ index + 1 }}</th>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <img v-if="user.image" :src="`/backend/images/users/${user.image}`" alt="User Image"
                                        width="55" height="55" />
                                    <span v-else>User has not provided an image</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
    name: "UserList",
    setup() {
        const users = ref([]);
        const loading = ref(false);
        const errors = ref({});

        const fetchUsers = async () => {
            try {
                loading.value = true;
                const response = await axios.get("/api/allusers");
                users.value = response.data;
            } catch (error) {
                console.error("Error fetching users:", error);
                errors.value = error.response?.data || {};
            } finally {
                loading.value = false;
            }
        };

        onMounted(() => {
            fetchUsers();
        });

        return {
            users,
            loading,
            errors,
        };
    },
};
</script>

<style scoped>
#searchInput {
    background: url("/backend/assets/img/searchicon.png") no-repeat 10px center;
    padding-left: 40px;
}
</style>
