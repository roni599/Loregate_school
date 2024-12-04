<!-- <template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5"
                    to="/admin-dashboard">Dashboard</router-link><span class="text-muted h5"> /
                    Student-information</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body">

                        <form @submit.prevent="submitForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" v-model="form.name"
                                            placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="gender">Gender</label>
                                        <input type="text" class="form-control" id="gender" v-model="form.gender"
                                            placeholder="Enter your gender">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="religion">Religion</label>
                                        <input type="text" class="form-control" id="religion" v-model="form.religion"
                                            placeholder="Enter your religion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-control" id="age" v-model="form.Age"
                                            placeholder="Enter your age">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="age">Date of Birth</label>
                                        <input type="text" class="form-control" id="age" v-model="form.DataofBirth"
                                            placeholder="Enter your date of birth">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="group" class="form-label">Birth Certificate No</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                v-model="formData.dateOfBirthChecked">
                                            <label class="form-check-label">Enable Birth Certificate No</label>
                                        </div>
                                        <input type="text" class="form-control" v-model="form.BirthCertificateNo"
                                            v-if="formData.dateOfBirthChecked" placeholder="Enter Birth Certificate No">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="group" class="form-label">NID No</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                v-model="formData.nidChecked">
                                            <label class="form-check-label">Enable NID No</label>
                                        </div>
                                        <input type="text" class="form-control" v-model="form.nidno"
                                            v-if="formData.nidChecked" placeholder="Enter NID No">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="group" class="form-label">Passport No</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                v-model="formData.passportChecked">
                                            <label class="form-check-label">Enable Passport No</label>
                                        </div>
                                        <input type="text" class="form-control" v-model="form.passportno"
                                            v-if="formData.passportChecked" placeholder="Enter Passport No">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="group" class="form-label">Nationality</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                v-model="formData.nationalityChecked">
                                            <label class="form-check-label">Enable Nationality</label>
                                        </div>
                                        <input type="text" class="form-control" v-model="form.nationality"
                                            v-if="formData.nationalityChecked" placeholder="Enter Nationality">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="group" class="form-label">E-Mail</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                v-model="formData.emailChecked">
                                            <label class="form-check-label">Enable E-Mail</label>
                                        </div>
                                        <input type="text" class="form-control" v-model="form.email"
                                            v-if="formData.emailChecked" placeholder="Enter E-Mail">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="group" class="form-label">Mobile</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                v-model="formData.mobileChecked">
                                            <label class="form-check-label">Enable Mobile</label>
                                        </div>
                                        <input type="text" class="form-control" v-model="form.mobile"
                                            v-if="formData.mobileChecked" placeholder="Enter Mobile">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue';

export default {
    name: "StudentInformation",
    setup() {
        const form = reactive({
            name: '',
            gender: '',
            Age: "",
            DataofBirth: '',
            BirthCertificateNo: '',
            nidno: '',
            passportno: '',
            nationality: '',
            email: '',
            mobile: '',
            religion: ''
        });
        const formData = reactive({
            dateOfBirthChecked: false,
            nidChecked: false,
            passportChecked: false,
            nationalityChecked: false,
            emailChecked: false,
            mobileChecked: false
        });
        const submitForm = () => {
            console.log(form);
        };

        return {
            formData,
            form,
            submitForm
        }
    }
}
</script>

<style></style> -->

<!-- <template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Student-information</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body mb-3">
                        <form @submit.prevent="submitForm">
                            <div v-for="(field, index) in fields" :key="index" class="form-group mb-3">
                                <label :for="'field_name_' + index">Field Name</label>
                                <input v-model="field.field_name" :id="'field_name_' + index" type="text"
                                    class="form-control mb-2 p-3" placeholder="Enter Field Name">

                                <label :for="'field_type_' + index">Field Type</label>
                                <select v-model="field.field_type" :id="'field_type_' + index"
                                    class="form-control p-3 mb-3">
                                    <option value="text">Text</option>
                                    <option value="select">Select</option>
                                    <option value="checkbox">Checkbox</option>
                                </select>

                                <div v-if="field.field_type === 'select'" class="form-group">
                                    <label for="options">Options (comma separated)</label>
                                    <input v-model="field.options" type="text" class="form-control mb-3 p-3"
                                        placeholder="e.g., Option 1, Option 2, Option 3">
                                </div>
                            </div>

                            <button type="button" @click="addField" class="btn btn-success">Add Field</button>
                            <button type="submit" class="btn btn-primary ms-3">Submit Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const fields = ref([
            {
                field_name: '',
                field_type: 'text',
                options: ''
            }
        ]);

        const addField = () => {
            fields.value.push({ field_name: '', field_type: 'text', options: '' });
        };

        const submitForm = async () => {
            const formData = {
                fields: fields.value.map(field => ({
                    field_name: field.field_name,
                    field_type: field.field_type,
                    options: field.options ? field.options.split(',') : []
                }))
            };

            try {
                const response = await axios.post('/api/forms', formData);
                console.log(response.data);
            } catch (error) {
                console.error(error);
            }
        };

        return {
            fields,
            addField,
            submitForm
        };
    }
};
</script> -->

<!-- final code for generate input-->
<!-- <template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Student-information</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body mb-3">
                        <form @submit.prevent="submitForm">
                            <div class="form-group mb-3">
                                <label for="field_name">Field Name</label>
                                <input v-model="field.field_name" id="field_name" type="text"
                                    class="form-control mb-2 p-3" placeholder="Enter Field Name">

                                <label for="field_type">Field Type</label>
                                <select v-model="field.field_type" id="field_type" class="form-control p-3 mb-4">
                                    <option value="text">text</option>
                                    <option value="password">password</option>
                                    <option value="email">email</option>
                                    <option value="select">select</option>
                                    <option value="date">date</option>
                                    <option value="textarea">textarea</option>
                                    <option value="file">file</option>
                                    <option value="button">button</option>
                                    <option value="number">number</option>
                                    <option value="radio">radio</option>
                                    <option value="checkbox">checkbox</option>
                                </select>

                                <div v-if="field.field_type === 'select'" class="form-group mb-4">
                                    <label for="options">Options (comma separated)</label>
                                    <input v-model="field.options" type="text" class="form-control mb-3 p-3"
                                        placeholder="e.g., Option 1, Option 2, Option 3">
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Submit Field</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const field = ref({
            field_name: '',
            field_type: 'text',
            options: ''
        });
        const submitForm = async () => {
            const formData = {
                field_name: field.value.field_name,
                field_type: field.value.field_type,
                options: field.value.options ? field.value.options.split(',') : []
            };

            console.log(field.value)

            try {
                const response = await axios.post('/api/forms/submit-field', formData);
                console.log(response.data);
                field.value.field_name = '';
                field.value.options = '';
            } catch (error) {
                console.error(error);
            }
        };

        return {
            field,
            submitForm
        };
    }
};

</script> -->

<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Student-information</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body mb-3">
                        <form @submit.prevent="submitForm">
                            <div class="form-group mb-3">
                                <label for="field_name">Field Name</label>
                                <input v-model="field.field_name" id="field_name" type="text"
                                    class="form-control mb-2 p-3" placeholder="Enter Field Name" required />

                                <label for="field_type">Field Type</label>
                                <select v-model="field.field_type" id="field_type" class="form-control p-3 mb-4">
                                    <option value="text">text</option>
                                    <option value="password">password</option>
                                    <option value="email">email</option>
                                    <option value="select">select</option>
                                    <option value="date">date</option>
                                    <option value="textarea">textarea</option>
                                    <option value="file">file</option>
                                    <option value="button">button</option>
                                    <option value="number">number</option>
                                    <option value="radio">radio</option>
                                    <option value="checkbox">checkbox</option>
                                </select>

                                <div v-if="field.field_type === 'select'" class="form-group mb-4">
                                    <label for="options">Options (comma separated)</label>
                                    <input v-model="field.options" type="text" class="form-control mb-3 p-3"
                                        placeholder="e.g., Option 1, Option 2, Option 3" />
                                </div>

                                <div class="form-check mb-4">
                                    <input v-model="field.required" id="required" type="checkbox"
                                        class="form-check-input" />
                                    <label for="required" class="form-check-label">Required Field</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Submit Field</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const field = ref({
            field_name: '',
            field_type: 'text',
            options: '',
            required: false
        });
        const submitForm = async () => {
            const formData = {
                field_name: field.value.field_name,
                field_type: field.value.field_type,
                options: field.value.options ? field.value.options.split(',') : [],
                required: field.value.required
            };

            try {
                const response = await axios.post('/api/fields/store', formData);
                if (response.data && response.data.message) {
                    resetForm();
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }


            } catch (error) {
                console.error('Error saving field:', error);
            }
        };
        const resetForm = () => {
            field.value.field_name = '';
            field.value.field_type = 'text';
            field.value.options = '';
            field.value.required = false;
        }

        return {
            field,
            submitForm,
            resetForm
        };
    }
};

</script>