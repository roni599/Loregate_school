<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Personal Information</h5>
                </div>
                <div class="card-body mb-3">
                    <form @submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="form_name">Form Name</label>
                                    <input v-model="formName" type="text" class="form-control mb-3"
                                        placeholder="e.g., Present , Permanent Address, Father,Mothter,Gurdian Infromation,Picture,Signature" />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Form Name</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name: "AdmissionassignformType",
    setup() {
        const formName = ref('');
        const currentComponent = ref(false);
        const submitForm = async () => {
            try {
                const response = await axios.post("/api/form-names/store", {
                    name: formName.value,
                });
                if (response.data && response.data.message) {
                    resetForm();
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error(error.response.data);
                alert("Failed to save the form name.");
            }
        };
        const resetForm = () => {
            formName.value = ''
        }
        return {
            formName,
            currentComponent,
            submitForm,
            resetForm
        }
    }
}
</script>

<style></style>