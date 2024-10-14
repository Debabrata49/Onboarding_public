<template>

    <div class="flex-container">
        <div class="text-item flex-container-inner">

            <div class="search-container" :class="{ active: isSearchActive }">
                <form @submit.prevent="searchAction">
                    <input type="text" v-model="searchQuery" placeholder="Search..." />
                </form>
                <button class="" @click="toggleSearch">
                    <i class="bi bi-search"></i>
                </button>
            </div>


            <div class="profile-button" @click="modalHandel">
                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726476490/uerewobugusvnamkcmco.png"
                    alt="profile-button">
            </div>
            <div class="log-out" :class="{ active: modalIsActive }">
                <h3>{{ merchant.business_name }}</h3>
                <p>coffee.to.go@gmail.com</p>
                <button @click="logoutCall">Log Out</button>
            </div>

        </div>
    </div>

    <div class="onboarding-body">

        <div class="txt-middle">
            <div class="text-left">

                <div class="txt-icon">
                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726477817/folder-with-files-svgrepo-com_1_epmxrz.png"
                        alt="txt-icon">
                </div>

                <div class="txt-content">
                    <h3 class="text">Sub-Accounts</h3>
                    <p>Total sub-accounts allowed: <span class="no_sub_acc">{{ merchant.no_sub_account }}</span> |  Active sub-accounts: 3</p>
                </div>
            </div>
            <div class="regular-button">
                <div class="button-content">
                    <i class="bi bi-plus-lg"></i>
                </div>
                <span>Create Sub-Account</span>
            </div>
        </div>


        <div class="onboarding-parent">
            <div class="onboarding-body-sub">

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th width="5%" class="col-name">Account Name</th>
                                <th width="10%" class="col-email">Email</th>
                                <th width="5%" class="col-password">Password</th>
                                <th width="5%" class="col-status">Status</th>
                                <th width="10%">Activated On</th>
                                <th width="10%" class="col-deactivate">Deactivated On</th>
                                <th width="5%">Valid Till</th>
                                <th width="5%">Outlet</th>
                                <th width="5%">Loyalty Structure</th>
                                <th width="7%" class="th-loyalty">Advanced Loyalty</th>
                                <th width="7%">POS Integration</th>
                                <th width="11%" class="th-communication">Communication</th>
                                <th width="5%">Permissions & Settings</th>
                                <th width="5%">Module Accesses</th>
                                <th width="5%">Edit Account</th>
                            </tr>
                        </thead>
                        <tbody v-if="!isLoading">
                            <tr v-for="i in accounts">
                                <td>
                                    <div class="content" :data-id="i.id" @click="loadEditAccToName(i.id, i, 'name')">
                                        {{ i.name }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>

                                <td>{{ i.email }}</td>
                                <td>
                                    <div class="content" @click="handleUser(i)">
                                        {{ i.password }}
                                        <i class="bi bi-pencil"></i>
                                    </div>
                                </td>
                                <td>{{ i.status }}</td>
                                <td>{{ i.active_on }}</td>
                                <td>{{ i.deactive_on }}</td>
                                <td>{{ i.valid_till }}</td>

                                <td>
                                    <div class="content">
                                        {{ i.outletname }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="content">
                                        {{ i.loyalty_percentage }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="content">
                                        {{ i.adv_loyalty }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="content">
                                        {{ i.pos_vendor_name }}
                                        <i class="bi bi-chevron-right"></i>
                                    </div>
                                </td>
                                <td>
                                    <ul>
                                        <li>{{ i.sms_vendor_name }}</li>
                                        <li>{{ i.promo_sms_vendor_name }}</li>
                                        <li>{{ i.whatsapp_vendor_name }}</li>
                                    </ul>
                                </td>
                                <td>{{ i.permission_text }}</td>
                                <td>{{ i.module_access }}</td>
                                <td>

                                    <div class="content" :data-id="i.id" @click="testModalHandle()">
                                        {{ i.edit }}
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr v-for="j in [...new Array(15)]">
                                <td v-for="k in [...new Array(15)]">
                                    <div class="cust-skeleton-loader"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <pagination v-if="accounts != ''" v-model="page" :records="total_entries" :per-page="limit"
            @paginate="pagination" />
        </div>

        
        <ModalPassword :modalPassword="modalPassword" :closeModal="closeModal"/>

        <!-- <div v-if="modalName" class="modal-overlay" @click.self="closeModalName">

            <div class="modalName">

                <div class="upper-new">
                    <i v-if="innerModal" class="bi bi-x-circle-fill" @click="innerModal = false"></i>
                    <i v-else class="bi bi-x-circle-fill" @click="closeModalName"></i>
                </div>

                <div class="name-form">

                    <div class="login-details">

                        <div class="login-heading">
                            <h4>Jumboking, Kolkata</h4>
                            <div class="name-icon">
                                <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1727073668/layer1_n2praq.svg"
                                    alt="name-icon">
                            </div>
                        </div>

                        <div class="login-content">

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-one'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726642562/kwdd8u4nbdwnm4d5nda3.svg"
                                        alt="login-icon">

                                    <p>Login Details</p>

                                </div>
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-two'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726657992/nixfuxmj09img99udgog.svg"
                                        alt="login-icon" />

                                    <p>Outlet Details</p>

                                </div>
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-three'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726722154/Group_fcrhwb.svg"
                                        alt="login-icon">

                                    <p>Loyalty Set - Up</p>

                                </div>
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-four'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726730085/folder-cloud-svgrepo-com_1_p1xcuj.svg"
                                        alt="login-icon">

                                    <p>Sub-Accounts Permission</p>

                                </div>
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-five'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726736519/chat-round-line-svgrepo-com_1_iz4p9s.svg"
                                        alt="login-icon">

                                    <p>Set communication channels</p>

                                </div>  
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-six'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726738258/pos-svgrepo-com_1_l5vqn0.svg"
                                        alt="login-icon">

                                    <p>Integrate with POS Vendor</p>

                                </div>
                                
                            </div>

                            <div class="field-container">

                                <div class="login-details-heading" @click="currentModalTab = 'tab-seven'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726738938/hashtag-square-svgrepo-com_1_jiqmg3.svg"
                                        alt="login-icon">

                                    <p>Manage POS level permissions</p>

                                </div>
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-eight'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742094/discount-svgrepo-com_2_1_kgb7s6.svg"
                                        alt="login-icon">

                                    <p>Offers</p>

                                </div>  
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-nine'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1726742390/campaign-svgrepo-com_1_vx4hkk.svg"
                                        alt="login-icon">

                                    <p>Manage Campaigns</p>

                                </div>  
                            </div>

                            <div class="field-container">
                                <div class="login-details-heading" @click="currentModalTab = 'tab-ten'">

                                    <img src="https://res.cloudinary.com/diktdm4c9/image/upload/v1728043238/Vector_umkhns.svg" alt="login-icon">

                                    <p>Membership Package</p>

                                </div>   
                            </div>
                        </div>

                    </div>

                    <div class="modal-tab">

                        <div v-if="currentModalTab === 'tab-one'" class="tab-one">

                            <div class="tab-content">
                                <h3>Login Details</h3>

                                <form class="modal-form" @submit.prevent="submitLoginForm">

                                    <div class="tab-div">
                                        <div class="login-form">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" v-model="loginForm.name">
                                        </div>

                                        <div class="login-form">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" disabled v-model="loginForm.email">
                                        </div>

                                        <div class="login-form">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" v-model="loginForm.address">
                                        </div>

                                        <div class="login-form">
                                            <label for="business">Business</label>
                                            <input type="text" name="business" id="business"
                                                v-model="loginForm.business">
                                        </div>
                                    </div>

                                    <div class="modal-sub">
                                        <button type="button" class="discard" @click="resetLoginForm">DISCARD</button>
                                        <button class="save" type="submit">SAVE</button>
                                    </div>

                                </form>

                            </div>

                        </div>

                        <div v-if="currentModalTab === 'tab-two'" class="tab-two">
                            <div class="tab-content">
                                <h3>Outlet Details</h3>

                                <form class="modal-form" @submit.prevent="submitOutletDetails">

                                    <div class="tab-div">
                                        <div class="login-form">
                                            <label for="email">Login Id</label>
                                            <input type="email" name="email" id="email" v-model="outletForm.email">
                                        </div>

                                        <div class="login-form">
                                            <label for="outlet">Outlet Name</label>

                                            <div class="input-holder">
                                                <input type="text" name="outlet" id="outlet"
                                                    v-model="outletForm.outletName">

                                                <div class="link">
                                                    <i class="bi bi-link cust-link-icon"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-sub">
                                        <button type="button" class="discard" @click="resetOutletForm">DISCARD</button>
                                        <button class="save" type="submit">SAVE</button>
                                    </div>



                                </form>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-three'" class="tab-three">
                            <div class="tab-content">
                                <h3>Loyalty Set - Up</h3>

                                <form class="modal-form" @submit.prevent="submitLoyaltyDetails">

                                    <div class="tab-div">

                                        <div class="login-form">
                                            <label for="flat">Flat</label>
                                            <input type="text" name="flat" id="flat" v-model="loyaltyForm.flat">
                                        </div>

                                        <div class="login-form">
                                            <label for="loyalty">Advanced Loyalty</label>
                                            <input type="text" name="text" id="loyalty" v-model="loyaltyForm.loyalty">
                                        </div>

                                    </div>

                                    <div class="modal-sub">
                                        <button type="button" class="discard" @click="resetLoyaltyForm">DISCARD</button>
                                        <button class="save" type="submit">SAVE</button>
                                    </div>


                                </form>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-four'" class="tab-four">

                            <div class="tab-content">

                                <h3>Sub-Accounts Permission</h3>

                                <form class="modal-form" @submit.prevent="submitSubaccountDetails">

                                    <div class="tab-div">

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Add Credits</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="addCredits" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Verify code</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="verifyCode" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Pending Requests</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="pendingRequests" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Redeem Credits</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="redeemCredits" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Custom e-wallet</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="customEwallet" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on discounted bill permission</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="pointsOnDiscountedBill" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on coupon redemption</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="pointsOnCouponRedemption" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on tax</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="pointsOnTax" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on discounted Item</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="pointsOnDiscountedItem" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Redeem/Add credits permission</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="redeemAddCreditsPermission" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="modal-sub">
                                        <button type="button" class="discard" @click="discardChanges">DISCARD</button>
                                        <button class="save" type="submit">SAVE</button>
                                    </div>


                                </form>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-five'" class="tab-five">
                            <div class="tab-content">
                                <h3>Set communication channels</h3>

                                <form class="modal-form" @submit.prevent="submitCommunicationDetails">

                                    <div class="tab-div">

                                        <div class="login-form">
                                            <label for="sms">SMS</label>
                                            <select name="sms" id="sms" v-model="selectedSms">
                                                <option value="*">Gupshup</option>
                                            </select>
                                        </div>

                                        <div class="login-form">
                                            <label for="whatsApp">WhatsApp</label>
                                            <select name="whatsApp" id="whatsApp" v-model="selectedWhatsApp">
                                                <option value="*">SMS Gateway Hub</option>
                                            </select>

                                        </div>

                                        <div class="login-form">
                                            <label for="route">Email</label>
                                            <select name="route" id="route" v-model="selectedEmail">
                                                <option value="*">Route Mobile</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-sub">
                                        <button class="discard">DISCARD</button>
                                        <button class="save" type="submit">SAVE</button>
                                    </div>


                                </form>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-six'" class="tab-six">

                            <div class="tab-content">

                                <h3>Integrate with POS Vendor</h3>

                                <form class="modal-form" @submit.prevent="submitPosvendorDetails">

                                    <div class="tab-div">

                                        <div class="login-form">
                                            <label for="vendor">Pos Vendor</label>
                                            <select name="vendor" id="vendor" v-model="posVendor">
                                                <option value="*">Generic</option>
                                            </select>
                                        </div>

                                        <div class="login-form">
                                            <label for="key">Customer Key</label>
                                            <input type="text" name="key" id="key" v-model="customerKey">
                                        </div>

                                    </div>

                                    <div class="modal-sub">
                                        <button type="button" class="discard" @click="resetPosvendorDetails">DISCARD</button>
                                        <button class="save" type="submit">SAVE</button>
                                    </div>


                                </form>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-seven'" class="tab-seven">

                            <div class="tab-content">

                                <h3>Manage POS level permissions</h3>

                                <form class="modal-form" @submit.prevent="submitPospermissionDetails">

                                    <div class="tab-div">

                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on coupon redemption</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="couponredemptionPoint" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on discounted bill permission</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="discountedbillPoint" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on discounted Item</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="discounteditemPoint" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Points on tax</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="taxPoint" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="txt-div">
                                            <div class="txt">
                                                <p>Redeem/Add credits permission</p>
                                            </div>
                                            <label class="switch">
                                                <input type="checkbox" v-model="creditsPermission" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="modal-sub">
                                        <button type="button" class="discard" @click="discardValues">DISCARD</button>
                                        <button class="save" type="submit">SAVE</button>
                                    </div>


                                </form>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-eight'" class="tab-eight">

                            <div class="tab-content">

                                <h3>Offers / Promos</h3>

                                <div class="modal-form" @submit.prevent="submitOfferDetails">

                                    <div class="tab-div">

                                        <div class="new-table">

                                            <table>

                                                <thead>
                                                    <tr>
                                                        <th class="name">Promo name</th>
                                                        <th class="validity">Promo Type</th>
                                                        <th class="issue">Validity</th>
                                                        
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td>classsic promo_01</td>
                                                        <td>Open</td>
                                                        <td>2nd Jan 23 to 4th April 24</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>classsic promo_01</td>
                                                        <td>Open</td>
                                                        <td>2nd Jan 23 to 4th April 24</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>classsic promo_01</td>
                                                        <td>Open</td>
                                                        <td>2nd Jan 23 to 4th April 24</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>classsic promo_01</td>
                                                        <td>Open</td>
                                                        <td>2nd Jan 23 to 4th April 24</td>
                                                        
                                                    </tr>

                                                    
                                                </tbody>

                                            </table>

                                        </div>


                                    </div>

                                    
                                </div>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-nine'" class="tab-nine">
                            <div class="tab-content">

                                <h3>Campaigns / Auto Engagement</h3>

                                <div class="modal-form" @submit.prevent="submitCampaignDetails">

                                    <div class="tab-div">

                                        <div class="new-table">

                                            <table>

                                                <thead>
                                                    <tr>
                                                        <th class="name">Name</th>
                                                        <th class="validity">Database</th>
                                                        <th class="days">Segment Name</th>
                                                        <th class="issue">Gratification</th>
                                                        <th class="segment">Communication</th>
                                                        <th class="issue">Trigger Frequency</th>
                                                        <th class="segment">Pause</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td>High_end_campaign_74</td>
                                                        <td>Full Database</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>View Details</td>
                                                        <td>Daily</td>
                                                        <td></td>
                                                    </tr>

                                                    

                                                    
                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <div v-if="currentModalTab === 'tab-ten'" class="tab-ten">
                            <div class="tab-content">

                                <h3>Membership Package</h3>

                                <div class="modal-form" @submit.prevent="submitPackageDetails">

                                    <div class="tab-div">

                                        <div class="new-table">

                                            <table>

                                                <thead>
                                                    <tr>
                                                        <th class="name">Name</th>
                                                        <th class="validity">Validity(days)</th>
                                                        <th class="issue">Total Issues</th>
                                                        <th class="days">Individual Issue Limit</th>
                                                        <th class="segment">Linked Segment</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Alaska Premium Package</td>
                                                        <td>40</td>
                                                        <td>4/Unlimited</td>
                                                        <td>Unlimited</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>

                                            </table>

                                        </div>

                                        <div class="overflow-auto">
    
                                            <b-pagination
                                            v-model="currentPage"
                                            :total-rows="rows"
                                            :per-page="perPage"
                                            aria-controls="my-table"
                                            prev-text="Prev"    
                                            next-text="Next"    
                                            hide-goto-end-buttons  
                                            class="my-pagination"  
                                            ></b-pagination>

                                            <p class="mt-3">Current Page: {{ currentPage }}</p>

                                            <b-table
                                            id="my-table"
                                            :items="paginatedData"   
                                            :per-page="perPage"
                                            :current-page="currentPage"
                                            small
                                            >
                                            

                                            </b-table>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div> -->
         
        <ModalName :modalName = "modalName" :closeModalName = "closeModalName"/>

        <EditModal :modalEdit = "modalEdit" :closeModalName="closeModalName"/>

        <!-- <div v-if="modalEdit" class="modal-overlay" @click.self="closeModalName">
            <div class="modalEdit">
                <div class="name-upper">
                    <h4>Edit Sub Account Details</h4>
                    <i class="bi bi-x-circle-fill" @click="closeModalName"></i>
                </div>
                <div class="edit-form">
                    <form class="form-edit" @submit.prevent="edit">


                        <div class="input-fields">
                            <div class="edit-input">
                            
                            <div>
                                <label for="name">Name <i class="bi bi-asterisk"></i></label>
                                <input type="text" name="emp_name"  v-model="emp_arr.emp_name" id="name" required>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="mobile">Mobile</label>
                                <input type="text" name="emp_mobile" v-model="emp_arr.emp_mobile" id="mobile">
                            </div>

                            </div>

                            <template v-if ="emp_loyalty_percentage_chk == 1">
                                <div class="edit-input">
                                
                                <div>
                                    <label for="loyaltypercent">Loyalty Program %</label>
                                    <input type="text" name="loyalty_percentage" v-model="emp_arr.emp_loyalty_percentage" id="loyaltypercent">
                                </div>

                                </div>
                            </template>

                            <div class="edit-input">
                            
                            <div>
                                <label for="email">Email ID <i class="bi bi-asterisk"></i></label>
                                <input type="email" name="emp_email" v-model="emp_arr.emp_email" id="email" required>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="pwd">Password <i class="bi bi-asterisk"></i></label>
                                <input type="password" name="password" v-model="emp_arr.emp_password" id="pwd" required>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="pwd_2">Confirm Password<i class="bi bi-asterisk"></i></label>
                                <input type="password" name="confirm_password" v-model="emp_arr.emp_confirm_password" id="pwd_2" required>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="bs">Business Name <i class="bi bi-asterisk"></i></label>
                                <input type="text" name="business_name" v-model="emp_arr.emp_business_name" id="bs" required>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="loc">Business Location</label>
                                <input type="text" name="business_location" v-model="emp_arr.emp_business_location" id="loc">
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="cat">Category</label>
                                <input type="text" name="emp_category" v-model="emp_arr.emp_category" id="cat">
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="country">Country</label>
                                <select name="country" id="country">
                                    <option>Please Select</option>
                                    <option v-for="country in emp_arr.emp_country" :key="country.value" :value="country.value" :selected="country.select">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="region">Region</label>
                                <select name="region" id="region">
                                    <option>Please Select</option>
                                    <option v-for="region in emp_arr.emp_region" :key="region.value" :value="region.value" :selected="region.select">
                                        {{ region.name }}
                                    </option>
                                </select>
                            </div>

                            </div>
                            <div class="multiple-fields-container">
                            
                            <div class="subfield-item">
                                <label for="asm_name">ASM Details</label>
                                <input type="text" name="asm_name" id="asm_name" v-model="emp_arr.asm_data.asm_name">
                            </div>

                            <div class="multiple-item">
                                <input type="email" name="asm_email" id="asm_email" v-model="emp_arr.asm_data.asm_email">
                            </div>

                            <div class="multiple-item">
                                <vue-tel-input
                                v-model="emp_arr.asm_data.asm_number"
                                mode="international"
                                :default-country="iso_code"
                                id="code"
                            ></vue-tel-input>
                            </div>

                            </div>
                            <div class="multiple-fields-container">
                            
                            <div class="subfield-item">
                                <label for="det">Manager Details</label>
                                <input type="text" name="det" id="det" v-model="emp_arr.manager_data.manager_name">
                            </div>

                            <div class="multiple-item">
                                <input type="email" name="mail" id="mail" v-model="emp_arr.manager_data.manager_email">
                            </div>

                            <div class="multiple-item">
                                <vue-tel-input
                                v-model="emp_arr.manager_data.manager_number"
                                mode="international"
                                :default-country="iso_code"
                                id="code"
                            ></vue-tel-input>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="curency">Currency</label>
                                <select name="curency" id="curency">
                                    <option>Please Select</option>
                                    <option v-for="curency in emp_arr.emp_currency" :key="curency.value" :value="curency.value" :selected="curency.select">
                                        {{ curency.name }}
                                    </option>
                                </select>
                            </div>

                            </div>
                            <div class="edit-input">
                            
                            <div>
                                <label for="timeZone">Time zone</label>
                                <select name="timeZone" id="timeZone">
                                    <option>Please Select</option>
                                    <option v-for="timeZone in emp_arr.emp_timezone" :key="timeZone.value" :value="timeZone.value" :selected="timeZone.select">
                                        {{ timeZone.name }}
                                    </option>
                                </select>
                            </div>

                            </div>

                            <div class="edit-input">
                                <div>
                                    <label for="note">Note</label>
                                    <textarea name="note" id="note" placeholder="Enter Note here">{{ emp_arr.emp_note }}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="submit">
                            <div class="btn-container">
                                <button class="discard">DISCARD</button>
                                <button class="save" type="submit">SAVE</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div> -->
    </div>

</template>

<script>

import { ref } from "vue";
import axiosService from "@/axiosService";
import Pagination from 'v-pagination-3';
import { VueTelInput } from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';
import EditModal from "./components/EditModal.vue";
import ModalPassword from "./components/ModalPassword.vue";
import ModalName from "./components/ModalName.vue"


export default {
    data() {
        return {
            isLoading: true,
            allowedAccounts: 20,
            activateAccounts: 3,
            accounts: [],
            merchant: '',
            isLoading: true,
            page: 1,
            current_page: 0,
            total_entries: 0,
            total_pages: 0,
            next_page: 0,
            limit: 0,
            modalIsActive: false,
            userObj: {},
            empObj: {},
            modalPassword: false,
            searchQuery: '',  // Moved searchQuery to data
            isSearchActive: false,
            shouldReCall: true,
            modalName: false,
            innerModal: false,
            modalEdit: false,
            form: {
                mobile: ''
            },

            iso_code: 'IN',
            isValidPhone: false,
            currentModalTab: 'tab-one',
            emp_arr: {
                emp_name: '',
                emp_email: '',
                emp_mobile: '',
                emp_password: '',
                emp_confirm_password: '',
                emp_business_name: '',
                emp_business_location: '',
                emp_category: '',
                emp_loyalty_percentage: '',
                emp_maxallow_award_trans: '',
                emp_loyalty_percentage_chk: 0,
                emp_note: '',
                asm_data: [],
                manager_data: [],
                emp_country: [],
                emp_currency: [],
                emp_timezone: [],
                emp_region: [],
            },

            loginForm: {
                name: '',
                email: 'user@example.com', // Default email, since it's disabled.
                address: '',
                business: ''
            },

            outletForm: {
                email: '',
                outletName: ''
            },

            loyaltyForm: {
                flat: '',
                loyalty: ''
            },

            addCredits: false,
            verifyCode: false,
            pendingRequests: false,
            redeemCredits: false,
            customEwallet: false,
            pointsOnDiscountedBill: false,
            pointsOnCouponRedemption: false,
            pointsOnTax: false,
            pointsOnDiscountedItem: false,
            redeemAddCreditsPermission: false,

            selectedSms: '*',
            selectedWhatsApp: '*',
            selectedEmail: '*',
            posVendor:'',
            customerKey:'',

            couponredemptionPoint:false,
            discountedbillPoint:false,
            discounteditemPoint:false,
            taxPoint:false,
            creditsPermission:false,

            perPage: 3,        
            currentPage: 1,

        };
    },

    computed: {
      rows() {
        return this.tableData ? this.tableData.length : 0;  
      },
      paginatedData() {
        
        if (this.tableData && this.tableData.length > 0) {
          const start = (this.currentPage - 1) * this.perPage;
          const end = start + this.perPage;
          return this.tableData.slice(start, end);
        }
        return [];
      }
    },

    components: {
        Pagination,
        VueTelInput,
        EditModal,
        ModalPassword,
        ModalName
    },

    setup() {
        const searchQuery = ref('');
        const isSearchActive = ref(false);
        const toggleSearch = () => {
            isSearchActive.value = !isSearchActive.value;
            if (isSearchActive.value) {
                searchQuery.value = null;
            }
            console.log(searchQuery.value);
            this.getEmployeeData(this.page, searchQuery.value);
        };

        return {
            searchQuery,
            isSearchActive,
            toggleSearch,
            // searchAction
        };

    },

    mounted() {
        this.getEmployeeData(this.page);
    },

    methods: {
        getEmployeeData(page_no, search = null) {
            let data = { page_number: page_no, search: search };
            axiosService.post("/api/getEmployeeData", data)
                .then(res => {
                    console.log(res.data.data);
                    this.isLoading = false;
                    this.accounts = res.data.data.employees;
                    this.merchant = res.data.data.merchant;
                    this.current_page = res.data.data.current_page;
                    this.total_entries = res.data.data.total_entries;
                    this.total_pages = res.data.data.total_pages;
                    this.limit = res.data.data.limit;
                    this.next_page = res.data.data.next_page;
                })
                .catch((err) => {
                    console.log(err);
                })
        },

        modalHandel() {
            this.modalIsActive = !this.modalIsActive;
            console.log(this.modalIsActive);
        },

        pagination() {
            this.isLoading = true;
            this.getEmployeeData(this.page);
        },

        loadEditAccToName(id, instance, modalName) {
            modalName === 'edit' && (this.modalEdit = true)
            modalName === 'name' && (this.modalName = true)
            this.editEmployeeProfile(id, this.shouldReCall);
        },
        loadEditSubAccount(id) {
            this.editEmployeeData(id, this.shouldReCall);
        },
        handleUser(value) {
            this.userObj = { ...value };

            if (this.userObj) {
                this.modalPassword = true;
                console.log(this.modalPassword);
            }
        },

        closeModal() {
            this.modalPassword = false;
        },

        closeModalName() {
            this.modalName = false;
            this.modalEdit = false
        },
        editEmployeeProfile(id, shouldReCall) {
            if (shouldReCall == false) {
                return false;
            }
            this.shouldReCall = false;
            let data = { employee_id: id };
            axiosService.post("/api/editEmployeeProfile", data)
                .then(res => {
                    console.log(res.data.data);
                    this.shouldReCall = true;
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        editEmployeeData(id, shouldReCall){
            if (shouldReCall == false) {
                return false;
            }
            this.shouldReCall = false;
            let data = { employee_id: id };
            axiosService.post("/api/getEditEmployeeMain", data)
                .then(res => {
                    console.log(res.data.data);
                    this.emp_arr = res.data.data;
                    this.modalEdit=true;
                })
                .catch((err) => {
                    console.log(err);
                }).finally(() => {
                    this.shouldReCall = true;
                });
        },
        toggleSearch() {
            this.isSearchActive = !this.isSearchActive;
            console.log(this.isSearchActive);
            if (this.isSearchActive) {
                this.searchQuery = '';
            } else {
                this.isLoading = true;
                this.getEmployeeData(this.page, this.searchQuery);
            }
        },

        logoutCall() {
            axiosService.post("/api/logout", [])
                .then(res => {
                    console.log(res.data);
                    if (res.data.error == false) {
                        localStorage.removeItem("access_token");
                        localStorage.removeItem("expires_in");
                        window.location.reload();
                    }
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    // Ensure the tokens are removed regardless of success or failure
                    localStorage.removeItem("access_token");
                    localStorage.removeItem("expires_in");
                    window.location.reload();
                });
        },

        switchModalTab(tabName) {
            this.currentModalTab = tabName;
        },

        submitLoginForm() {
            console.log('Login Form Data:', this.loginForm);
            this.loginForm = { name: '', email: '', address: '', business: '' };
        },

        resetLoginForm() {
            this.loginForm = {
                name: '',
                email: 'user@example.com', 
                address: '',
                business: ''
            };
        },

        submitOutletDetails() {
            console.log('Outlet Details:', this.outletForm);
            this.resetOutletForm();
        },

        resetOutletForm() {
            this.outletForm = {
                email: '',
                outletName: ''
            };
        },

        submitLoyaltyDetails() {
            console.log('Login Form Data:', this.loyaltyForm);
            this.loyaltyForm = { flat: '', loyalty: ''};
        },

        resetLoyaltyForm() {
            this.loyaltyForm = {
                flat: '',
                loyalty: ''
            };
        },

        submitSubaccountDetails() {

        const formData = {
            addCredits: this.addCredits,
            verifyCode: this.verifyCode,
            pendingRequests: this.pendingRequests,
            redeemCredits: this.redeemCredits,
            customEwallet: this.customEwallet,
            pointsOnDiscountedBill: this.pointsOnDiscountedBill,
            pointsOnCouponRedemption: this.pointsOnCouponRedemption,
            pointsOnTax: this.pointsOnTax,
            pointsOnDiscountedItem: this.pointsOnDiscountedItem,
            redeemAddCreditsPermission: this.redeemAddCreditsPermission,
        };

        console.log('Form Data:', formData);

        this.resetForms();

        },

        discardChanges() {
        this.resetForms();
        },

        resetForms() {   
        this.addCredits = false;
        this.verifyCode = false;
        this.pendingRequests = false;
        this.redeemCredits = false;
        this.customEwallet = false;
        this.pointsOnDiscountedBill = false;
        this.pointsOnCouponRedemption = false;
        this.pointsOnTax = false;
        this.pointsOnDiscountedItem = false;
        this.redeemAddCreditsPermission = false;
        },

        submitCommunicationDetails() {
            console.log("Selected SMS:", this.selectedSms);
            console.log("Selected WhatsApp:", this.selectedWhatsApp);
            console.log("Selected Email:", this.selectedEmail);

      // Make an API call with the selected data
            const communicationDetails = {
                sms: this.selectedSms,
                whatsApp: this.selectedWhatsApp,
                email: this.selectedEmail,
            }; 

        },

        resetCommunicationDetails() {
            this.selectedSms = '*';
            this.selectedWhatsApp = '*';
            this.selectedEmail = '*';
        },

        submitPosvendorDetails() {
            
            console.log('POS Vendor:', this.posVendor);
            console.log('Customer Key:', this.customerKey);

            const formData = {
                vendor: this.posVendor,
                key: this.customerKey
            };

        },

        resetPosvendorDetails() {
            this.posVendor = '';
            this.customerKey = '';
        },

        submitPospermissionDetails(){

            const newData = {

                couponredemptionPoint: this.couponredemptionPoint,
                discountedbillPoint: this.discountedbillPoint,
                discounteditemPoint: this.discounteditemPoint,
                taxPoint: this.taxPoint,
                creditsPermission: this.creditsPermission
            };

            console.log('New Data:', newData);

            this.resetPermission();

        },

        discardValues() {
        this.resetPermission();
        },

        resetPermission(){
            this.couponredemptionPoint = false,
            this.discountedbillPoint = false,
            this.discounteditemPoint = false,
            this.taxPoint = false,
            this.creditsPermission = false
        },

        testModalHandle(){
            this.modalEdit = true;
        }
    }
};

</script>
