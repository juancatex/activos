<script setup>
    import Checkbox from '@/Components/Checkbox.vue'; 
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import {
        Head, 
        useForm
    } from '@inertiajs/vue3';

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };

</script>

<template>

    <Head title="Inicio" />
    <div class="row auth-wrapper gx-0">
        <div class="col-lg-3 bg-info auth-box-2 on-sidebar">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="row justify-content-center text-center">
                    <div class="col-md-7 col-lg-12 col-xl-9">
                        <div>
                            <span class="db"><img src="/assets/images/muge.png" alt="logo" style="width: 100%;"/></span> 
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="     col-lg-9  d-flex    align-items-center   justify-content-center ">
            <div class="row justify-content-center w-100 mt-4 mt-lg-0">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-7 col-lg-12 col-xl-9">
                                <div style="    padding: 7%;">
                                   <img src="/assets/images/logmu.png" alt="logo"  style="width: 100%;"/>
                                </div> 
                            </div>
                            <h2 style="font-weight: bold;text-align: center;font-size: x-large !important;">Sistema de
                                Gestion de <br> Activos Fijos</h2>

                            <form class="form-horizontal mt-4 pt-4 needs-validation" @submit.prevent="submit">


                                <div class="mb-3">
                                    <InputLabel for="email" value="Correo electronico" />
                                    <TextInput id="email" type="email" class="form-control form-input-bg"
                                        v-model="form.email" required autofocus autocomplete="username" />

                                    <InputError class="invalid-feedback" :message="form.errors.email" />
                                </div>

                                <div class=" mb-3">
                                    <InputLabel for="password" value="Contraseña" />
                                    <TextInput id="password" type="password" class="form-control"
                                        v-model="form.password" required />

                                    <InputError class="invalid-feedback" :message="form.errors.password" />
                                </div>


                                <div class="d-flex align-items-center mb-3">
                                    <div class="form-check">
                                        <Checkbox class="form-check-input" name="remember"
                                            v-model:checked="form.remember" />
                                        <label class="form-check-label">
                                            Recordar
                                        </label>
                                    </div>


                                </div>

                                <div class="d-flex align-items-stretch button-group mt-4 pt-2">
                                    <PrimaryButton class="btn btn-info btn-lg px-4" :disabled="form.processing" style="width: 100%;">
                                      Ingresar
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>
