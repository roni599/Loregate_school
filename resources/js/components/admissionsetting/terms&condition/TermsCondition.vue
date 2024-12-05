<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Terms-condition</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Terms & Conditions Create</h5>
                    </div>
                    <div class="card-body mb-3">
                        <form action="" @submit.prevent="saveTerms">
                            <label for="termscondition" class="mb-1">Terms & Conditions</label>
                            <textarea v-model="newItem" class="form-control mb-3" rows="5"
                                placeholder="Add Education Name"></textarea>
                            <button class="btn btn-primary mt-2 w-100">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";

export default {
    name: "TermsCondition",
    setup() {
        const newItem = ref('');
        const saveTerms = async () => {
            try {
                const response = await axios.post("/api/terms-conditions/storeUpdate", {
                    content: newItem.value,
                });
                if (response.data && response.data.message) {
                    fetchtermscondition()
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error(error);
            } finally {

            }
        };

        const fetchtermscondition = async () => {
            try {
                const response = await axios.get(`/api/terms-conditions`);
                if (response.data && response.data.message) {
                    newItem.value = response.data.data.content
                }
            } catch (error) {
                console.log(error)
            }
        }
        onMounted(() => {
            fetchtermscondition()
        })
        return {
            newItem,
            saveTerms
        };
    },
};
</script>

<style></style>