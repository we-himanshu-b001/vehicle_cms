<script setup>
import {onMounted, ref, watch} from "vue";
import { useConsumerApplicationStore } from '../../stores/store-consumerapplications'
import { useVehicleStore } from "../../stores/store-vehicles";

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';

const vstore = useVehicleStore();
const store = useConsumerApplicationStore();
const route = useRoute();
const vid = ref('');

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

// watch(
//     () => store.item?.vehicle_id,
//     async (newVal) => {
//         if (newVal) {
//             console.log(newVal);
//             await vstore.getItem(newVal);// Calls getItem with the updated vehicle_id
//         }
//     }
// );

//--------form_menu
const form_menu = ref();
const toggleFormMenu = (event) => {
    form_menu.value.toggle(event);
};
//--------/form_menu

</script>
<template>

    <div class="col-6" >

        <Panel class="is-small" v-if="store.item && !store.item.deleted_at">

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
                            data-testid="consumerapplications-view_item"
                            @click="store.toView(store.item)"
                            icon="pi pi-eye"/>

                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="consumerapplications-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create & New"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="consumerapplications-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
                    <Button
                        type="button"
                        @click="toggleFormMenu"
                        class="p-button-sm"
                        data-testid="consumerapplications-form-menu"
                        icon="pi pi-angle-down"
                        aria-haspopup="true" aria-hidden="true" />

                    <Menu ref="form_menu"
                          :model="store.form_menu_list"
                          :popup="true" />
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="consumerapplications-to-list"
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


                <VhField label="Customer Name">
                    <Dropdown v-model="store.item.customer_id" :options="store.assets.customer_list" optionLabel="name" optionValue="id" placeholder="Select a customer" class="w-full " filter/>
                </VhField>

                <VhField label="Vehicle Name">
                    <Dropdown v-model="store.item.vehicle_id" @change="vstore.getItem(store.item.vehicle_id)" :options="store.assets.vehicle_list" optionLabel="name" optionValue="id" placeholder="Select a vehicle" class="w-full " filter/>
                </VhField>


                <VhField v-if="vstore.item && store.item.vehicle_id">
                    <DataTable :value="[vstore.item]" class="w-full">
                        <Column field="model" header="Model" />
                        <Column field="mileage" header="Mileage(km/h)" />
                        <Column field="company" header="Company" />
                        <Column field="fuel_type" header="Fuel Type" />
                        <Column field="transmission" header="Transmission" />
                        <Column field="price" header="Price(₹)" />
                    </DataTable>
                </VhField>

                <VhField label="Description">
                    <div class="p-inputgroup">
                        <InputText class="w-full"
                                     placeholder="Enter the description/note"
                                     name="customers-description"
                                     data-testid="customers-description"
                                     v-model="store.item.description"/>
                    </div>
                </VhField>

                <VhField label="Loan Applied">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 name="customers-loan-applied"
                                 data-testid="customers-loan-applied"
                                 v-model="store.item.loan_applied"/>
                </VhField>

                <VhField label="Advance Amount">
                    <div class="p-inputgroup">
                        <InputNumber class="w-full"
                                     placeholder="Enter the advance amount(if any)"
                                     name="customers-advance-amount"
                                     data-testid="customers-advance-amount"
                                     v-model="store.item.advance_amount"/>
                    </div>
                </VhField>

                <VhField label="Pending Amount">
                    <div class="p-inputgroup">
                        <InputNumber class="w-full"
                                     placeholder="Enter the pending amount"
                                     name="customers-pending-amount"
                                     data-testid="customers-pending-amount"
                                     v-model="store.item.pending_amount" required/>
                        <div class="required-field hidden"></div>
                    </div>
                </VhField>

                <VhField label="Status">
                    <Dropdown v-model="store.item.status" :options="store.assets.application_status_list" optionLabel="name" optionValue="slug" placeholder="Select a status" class="w-full "/>
                </VhField>

            </div>
        </Panel>
        <Panel v-else>
            <Message severity="error"
                     class="p-container-message mb-3"
                     :closable="false"
                     icon="pi pi-trash"
                     v-if="store.item.deleted_at">

                <div class="flex align-items-center justify-content-between">

                    <div class="">
                        Deleted at {{store.item.deleted_at}}
                    </div>

                    <div class="ml-3">
                        Restore the record to edit
                        <Button label="Restore"
                                class="p-button-sm"
                                data-testid="articles-item-restore"
                                @click="store.itemAction('restore')">
                        </Button>
                    </div>

                </div>

            </Message>
        </Panel>

    </div>

</template>
