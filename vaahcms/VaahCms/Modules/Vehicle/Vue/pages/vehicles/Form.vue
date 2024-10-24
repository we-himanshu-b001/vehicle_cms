<script setup>
import {onMounted, ref, watch} from "vue";
import { useVehicleStore } from '../../stores/store-vehicles'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';


const store = useVehicleStore();
const route = useRoute();

onMounted(async () => {
    /**
     * Fetch the record from the database
     */
    if((!store.item || Object.keys(store.item).length < 1)
            && route.params && route.params.id)
    {
        await store.getItem(route.params.id);
    }

    await store.getFormMenu();
});

//--------form_menu
const form_menu = ref();
const toggleFormMenu = (event) => {
    form_menu.value.toggle(event);
};
//--------/form_menu

</script>
<template>

    <div class="col-6" >

        <Panel class="is-small">

            <template class="p-1" #header>


                <div class="flex flex-row">
                    <div class="p-panel-title">
                        <span v-if="store.item && store.item.id">
                            Update
                        </span>
                        <span v-else>
                            Create
                        </span>
                    </div>

                </div>


            </template>

            <template #icons>


                <div class="p-inputgroup">

                    <Button class="p-button-sm"
                            v-tooltip.left="'View'"
                            v-if="store.item && store.item.id"
                            data-testid="vehicles-view_item"
                            @click="store.toView(store.item)"
                            icon="pi pi-eye"/>

                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="vehicles-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create & New"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="vehicles-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
                    <Button
                        type="button"
                        @click="toggleFormMenu"
                        class="p-button-sm"
                        data-testid="vehicles-form-menu"
                        icon="pi pi-angle-down"
                        aria-haspopup="true"/>

                    <Menu ref="form_menu"
                          :model="store.form_menu_list"
                          :popup="true" />
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="vehicles-to-list"
                            @click="store.toList()">
                    </Button>
                </div>



            </template>


            <div v-if="store.item" class="mt-2">

                <Message severity="error"
                         class="p-container-message mb-3"
                         :closable="false"
                         icon="pi pi-trash"
                         v-if="store.item.deleted_at">

                    <div class="flex align-items-center justify-content-between">

                        <div class="">
                            Deleted {{store.item.deleted_at}}
                        </div>

                        <div class="ml-3">
                            <Button label="Restore"
                                    class="p-button-sm"
                                    data-testid="articles-item-restore"
                                    @click="store.itemAction('restore')">
                            </Button>
                        </div>

                    </div>

                </Message>


                <VhField label="Name">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the name"
                                   name="vehicles-name"
                                   data-testid="vehicles-name"
                                   @update:modelValue="store.watchItem"
                                   v-model="store.item.name" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Company">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the company name"
                                   name="vehicles-company"
                                   data-testid="vehicles-company"
                                   v-model="store.item.company" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Model">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the model"
                                   name="vehicles-model"
                                   data-testid="vehicles-model"
                                   v-model="store.item.model" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Manufacturing Year">
                    <div class="p-inputgroup">
                        <InputNumber class="w-full" :min="1900" :max="2100"
                                   placeholder="Enter the manufacturing year between 1900 to 2100"
                                   name="vehicles-manufacturing-year"
                                   data-testid="vehicles-manufacturing-year"
                                   v-model="store.item.manufacturing_year" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Color">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                   placeholder="Enter the color"
                                   name="vehicles-color"
                                   data-testid="vehicles-color"
                                   v-model="store.item.color" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Mileage">
                    <div class="p-inputgroup">
                        <InputNumber class="w-full" :min="1" :max="1000"
                                   placeholder="Enter the mileage between 1 and 1000"
                                   name="vehicles-mileage"
                                   data-testid="vehicles-mileage"
                                   v-model="store.item.mileage" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Price (₹)">
                    <div class="p-inputgroup">
                        <InputNumber class="w-full" :minFractionDigits="2" :maxFractionDigits="8"
                                   placeholder="Enter the price" locale="en-IN"
                                   name="vehicles-price"
                                   data-testid="vehicles-price"
                                   v-model="store.item.price" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>



                <VhField label="Fuel Type">

<!--                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Select a City" class="w-full md:w-14rem" />-->
                    <select
                            class="w-full p-inputtext"
                            name="vehicles-fuel-type"
                            data-testid="vehicles-fuel-type"
                            v-model="store.item.fuel_type" required>
                        <option disabled value="">Please select one</option>
                        <option value="petrol">Petrol</option>
                        <option value="diesel">Diesel</option>
                        <option value="electric">Electric</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </VhField>

                <VhField label="Transmission">
                    <select
                        class="w-full p-inputtext"
                        name="vehicles-transmission"
                        data-testid="vehicles-transmission"
                        v-model="store.item.transmission" required>
                        <option disabled value="">Please select one</option>
                        <option value="manual">Manual</option>
                        <option value="automatic">Automatic</option>
                    </select>
                </VhField>


            </div>
        </Panel>

    </div>

</template>
