<template>
    <div class="main-div">
        <div class="container-fluid admissionfair">
            <div class="contentload w-100 d-flex justify-content-between align-items-center w-100">
                <div class="content-image-academy-details w-100 d-flex align-items-center w-75">
                    <router-link to="/" class="academy-image me-3">
                        <img src="../../../../../public/frontend/images/efiailogo.png" width="95" height="95"
                            alt="Eternal Freedom Institute Logo" />
                    </router-link>

                    <div class="academy-details" style="line-height: 1">
                        <p>Eternal Freedom Institute Al Islamia</p>
                        <p>Gafargaon, Mymensing , Mymensingh</p>
                        <p>01711-022734</p>
                    </div>
                </div>
                <!-- Align this div to the right end -->
                <div class="admissionfaircontent d-flex justify-content-end align-items-center w-25">
                    <h1 class="text-white fw-bold me-4">ভর্তি মেলা</h1>
                </div>
            </div>
        </div>
        <h6 class="text-center fw-bold py-3 onlineadmission">
            Online Admission Form
        </h6>
        <div class="container mb-5">
            <div class="card">
                <div class="card-body">
                    <p class="mb-2">
                        <span class="addmissionclass fw-bold">Admission Class </span> :
                        One/2024/Day/A
                    </p>
                    <p class="fee fw-bold mb-4">Fee: 520</p>
                    <p class="studentinformation mb-2">Student Information</p>
                    <form action="" class="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Name</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Gender</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Religion</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddhu">Buddhu</option>
                                        <option value="Khiristan">Khiristan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Age</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Data of Birth</label>
                                    <input type="date" class="form-control" id="dateinput" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Birth Certificate No</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">NID No</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Passport No</label>
                                    <input type="text" class="form-control" id="dateinput" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Nationality</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Inida">Inida</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Napal">Napal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">E-Mail</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Mobile</label>
                                    <input type="text" class="form-control" id="dateinput" />
                                </div>
                            </div>
                        </div>
                        <p class="studentinformation mb-2">Present Address</p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Division</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Inida">Inida</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Napal">Napal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Division</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Inida">Inida</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Napal">Napal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Division</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Inida">Inida</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Napal">Napal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="divisionTextarea" class="form-label mb-0">Address Details</label>
                                    <textarea name="division" id="divisionTextarea" class="form-control" rows="3"
                                        placeholder="Enter division details"></textarea>
                                </div>
                            </div>
                        </div>
                        <p class="studentinformation mb-2">Fathers Information</p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Name</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">NID No</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Passport No</label>
                                    <input type="text" class="form-control" id="dateinput" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Mail</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Moblile</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Nationality</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Inida">Inida</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Napal">Napal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <p class="studentinformation mb-2">Mothers Information</p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Name</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">NID No</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Passport No</label>
                                    <input type="text" class="form-control" id="dateinput" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Mail</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Moblile</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Nationality</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Inida">Inida</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Napal">Napal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <p class="studentinformation mb-2">Guardian Information</p>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Name</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">NID No</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Passport No</label>
                                    <input type="text" class="form-control" id="dateinput" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Mail</label>
                                    <input type="text" class="form-control" id="nameinput" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Moblile</label>
                                    <input type="text" class="form-control" id="ageinput" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Nationality</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Inida">Inida</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Napal">Napal</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">
                                        Relation of Student</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Brother">Brother</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="divisionTextarea" class="form-label mb-0">Address Details</label>
                                    <textarea name="division" id="divisionTextarea" class="form-control" rows="3"
                                        placeholder="Enter address details"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label mb-0">Contract Person</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Brother">Brother</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <p class="studentinformation mb-2">Previous Academy Information</p>
                        <table class="table table-bordered mb-3">
                            <thead>
                                <tr>
                                    <th>Education</th>
                                    <th>Academy Name</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Group</th>
                                    <th>Roll</th>
                                    <th>Final Exam Resul</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in rows" :key="row.id">
                                    <td>
                                        <input v-model="row.column1" type="text" class="form-control"
                                            placeholder="Enter Education Name" />
                                    </td>
                                    <td>
                                        <input v-model="row.column2" type="text" class="form-control"
                                            placeholder="Enter Academy Name" />
                                    </td>
                                    <td>
                                        <input v-model="row.column3" type="text" class="form-control"
                                            placeholder="Enter passing year" />
                                    </td>
                                    <td>
                                        <input v-model="row.column3" type="text" class="form-control"
                                            placeholder="Enter class" />
                                    </td>
                                    <td>
                                        <input v-model="row.column3" type="text" class="form-control"
                                            placeholder="Enter Group" />
                                    </td>
                                    <td>
                                        <input v-model="row.column3" type="text" class="form-control"
                                            placeholder="Enter Roll" />
                                    </td>
                                    <td>
                                        <input v-model="row.column3" type="text" class="form-control"
                                            placeholder="Enter Result" />
                                    </td>
                                    <td class="text-center">
                                        <button v-if="index === rows.length - 1" @click="addRow"
                                            class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <button v-if="rows.length > 1" @click="removeRow(index)"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-center gap-5 text-center">
                                        <img src="../../../../../public/frontend/images/image.png"
                                            @click="$refs.fileInput1.click()" alt="Image 1" width="50" height="50"
                                            style="cursor: pointer;">
                                        <input type="file" ref="fileInput1" style="display: none;" />
                                        <img src="../../../../../public/frontend/images/digital-signature.png"
                                            @click="$refs.fileInput2.click()" alt="Image 2" width="50" height="50"
                                            style="cursor: pointer;">
                                        <input type="file" ref="fileInput2" style="display: none;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-5">
                            <div class="terms-container">
                                <p class="fw-bold">Terms & Conditions</p>
                                <div class="terms-content">
                                    <ul class="terms-list">
                                        <li>Every admission requires some paperwork. You need to check your</li>
                                        <li>eligibility for admission as an article-ship student at a CA Firm in</li>
                                        <li>Bangladesh first. ICAB has made an equal opportunity for both</li>
                                        <li>students from National Curriculum and English medium in</li>
                                        <li>Bangladesh. So, no worry since it’s easier now than any other time.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Agree</label>
                                </div>
                            </div>
                        </div>
                        <div class="button-forgate d-flex justify-content-between w-100 align-items-center">
                            <router-link to="/admissionformview" type="submit"
                                class="loginbutton btn btn-sm text-white fw-bold ms-auto">Next</router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
export default {
    name: "AdmissionForm",
    setup() {
        const rows = ref([
            { id: 1, column1: "", column2: "", column3: "", column4: "", column5: "", column6: "", column7: "" },
        ]);
        const addRow = () => {
            const newId = rows.value.length + 1;
            rows.value.push({ id: newId, column1: "", column2: "", column3: "", column4: "", column5: "", column6: "", column7: "" });
        };
        const removeRow = (index) => {
            rows.value.splice(index, 1);
        };
        return {
            rows,
            addRow,
            removeRow,
        };
    },
};
</script>

<style scoped>
.onlineadmission {
    color: #5586c7;
}

.admissionfair {
    width: 100%;
    height: 10vh;
    background-color: #d00473;
}

.academy-details p {
    line-height: 0.2;
    color: white;
}

.addmissionclass {
    color: #d00473;
}

.fee {
    color: #4ea49a;
}

.studentinformation {
    color: #2865b8;
    font-weight: bold;
}

.loginbutton {
    background-color: #2865b8;
    border-radius: 15px;
    padding: 5px 15px;
}

@media (max-width: 768px) {
    table thead {
        display: none;
    }

    table,
    thead,
    tbody,
    th,
    td,
    tr {
        display: block;
        width: 100%;
    }

    tr {
        margin-bottom: 10px;
    }

    td {
        text-align: center;
        /* Center the content in the td cell */
        position: relative;
        padding-left: 0;
    }

    td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
    }
}
</style>