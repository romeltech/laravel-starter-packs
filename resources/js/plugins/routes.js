// import Dashboard from "../components/dashboard/Dashboard";
// import Settings from "../components/admin/Settings";
// import Companies from "../components/admin/Companies";
// import Categories from "../components/admin/Categories";
// import EditCategory from "../components/system/EditCategory";
// import NewCategory from "../components/system/NewCategory";
// import Users from "../components/admin/Users";
// import EditUser from "../components/user/admin/EditUser";
// import NewUser from "../components/user/admin/NewUser";
// import Suppliers from "../components/user/supplier/Suppliers";
// import EditSuppliers from "../components/user/supplier/EditSupplier";
// import NewSuppliers from "../components/user/supplier/NewSupplier";
// import Departments from "../components/admin/Departments";
// import SuppApproval from "../components/admin/Supplierapproval";
// import MyRequests from "../components/user/requests/MyRequests";
// import viewRequisition from "../components/user/requests/details/viewRequisition";
// import NewRequest from "../components/user/requests/NewRequest";
// import MyApprovals from "../components/user/approvals/MyApprovals";
// import SupplierApprovals from "../components/user/approvals/SupplierApprovals";
// import ReviewSupplier from "../components/user/approvals/ReviewSupplier";
// import SupplierProfile from "../components/supplier/SupplierProfile";
// import UserProfile from "../components/user/profile/UserProfile";
// import ItemRequests from "../components/supplier/ItemRequests";
// import Quotations from "../components/supplier/Quotations";
// import SingleQuotation from "../components/supplier/details/SingleQuotation";
// import ProcurementPRF from "../components/procurement/RequisitionList";
// import viewPrfProcurement from "../components/procurement/details/viewPrf";
// import RequestApprovals from "../components/user/approvals/RequestApprovals";
// // Items
// import ItemsMaster from "../components/admin/ItemsMaster";
// import NewItem from "../components/system/NewItem";
// import EditItem from "../components/system/EditItem";
// // Catalog
// import ItemsCatalog from "../components/admin/ItemsCatalog";
// import NewCatalog from "../components/system/NewCatalog";
// import EditCatalog from "../components/system/EditCatalog";
// import ApprovalStages from "../components/admin/approval_stages/ApprovalStages";

// import LPOlist from "../components/procurement/purchasedOrders";
// import SingleLPO from "../components/procurement/details/singlePurchasedOrder";
// import CreateLPO from "../components/procurement/details/createPurchaseOrder";

// import ImportPage from "../components/admin/ImportPage";
// import ImportEmployees from "../components/admin/import/ImportEmployees";

// import ForbiddenPage from "../components/error_pages/ForbiddenPage";
// import NotFoundPage from "../components/error_pages/NotFoundPage";

// // Vuex's store
// import store from "../store";
// let auth = store.state.authUser;
// let procurement_access = ["admin", "procurement"];
// let finance_access = ["admin", "finance"];
// let employee_access = ["admin", "employee"];
// let employee_finance_access = ["admin", "employee", "finance"];
// let supplier_access = ["admin", "supplier"];
// let procurement_supplier_access = ["admin", "procurement", "supplier"];
// let finance_procurement_access = ["admin", "finance", "procurement"];
// let all_access = ["admin", "procurement", "supplier","employee", "finance"];
// let employee_finance_procurement_access = ["admin","procurement", "employee", "finance"];
// export const routes = [
//     /**
//      * Error Pages
//      */
//     {
//         path: "/forbidden",
//         component: ForbiddenPage,
//         name: "ForbiddenPage"
//     },
//     {
//         path: "/notfound",
//         component: NotFoundPage,
//         name: "NotFoundPage"
//     },

//     /**
//      * Common Pages
//      */
//     {
//         path: "/d/dashboard",
//         component: Dashboard,
//         name: "dashboard"
//     },
//     {
//         path: "/d/my-requests",
//         component: MyRequests,
//         name: "MyRequests",
//         beforeEnter: (to, from, next) => {
//             employee_finance_procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/profile",
//         component: UserProfile,
//         name: "UserProfile"
//     },
//     {
//         path: "/d/request/new",
//         component: NewRequest,
//         name: "NewRequest",
//         beforeEnter: (to, from, next) => {
//             employee_finance_procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/my-requests/prf/:id",
//         component: viewRequisition,
//         name: "prf-view"
//     },

//     {
//         path: "/d/catalog/edit/:id",
//         component: EditCatalog,
//         name: "catalog-edit"
//     },
//     {
//         path: "/d/catalog/new",
//         component: NewCatalog,
//         name: "catalog-new"
//     },
//     {
//         path: "/d/catalogs",
//         component: ItemsCatalog,
//         name: "catalog-lists"
//     },

//     /**
//      * Procurement Access
//      */
//     {
//         path: "/d/import",
//         component: ImportPage,
//         name: "ImportPage",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/import/users",
//         component: ImportEmployees,
//         name: "ImportEmployees",
//         props: true,
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/item/edit/:id",
//         component: EditItem,
//         name: "items-master-edit",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/items/new",
//         component: NewItem,
//         name: "items-master-new",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/items",
//         component: ItemsMaster,
//         name: "items-master",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/item-categories",
//         component: Categories,
//         name: "categories",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/item-categories/new",
//         component: NewCategory,
//         name: "newCategory",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/item-categories/edit/:id",
//         component: EditCategory,
//         name: "editCategory",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/suppliers/new",
//         component: NewSuppliers,
//         name: "NewSupplier",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/suppliers/edit/:id",
//         component: EditSuppliers,
//         name: "EditSupplier",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/supplier-quotations",
//         component: Quotations,
//         name: "supplier-quotation",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/create-purchase-order",
//         component: CreateLPO,
//         name: "create-lpo",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/purchased-order/s/:id",
//         component: SingleLPO,
//         name: "single-purhcased-order",
//         beforeEnter: (to, from, next) => {
//             employee_finance_procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/purchased-orders",
//         component: LPOlist,
//         name: "purhcased-orders",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/procurement-prf-list",
//         component: ProcurementPRF,
//         name: "procurement-prf-list",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/my-approvals",
//         component: MyApprovals,
//         name: "MyApprovals",
//         beforeEnter: (to, from, next) => {
//             employee_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     /**
//      * Finance Procurement
//      */
//     {
//         path: "/d/suppliers",
//         component: Suppliers,
//         name: "suppliers",
//         beforeEnter: (to, from, next) => {
//             finance_procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/supplier-approvals",
//         component: SupplierApprovals,
//         name: "SupplierApprovals",
//         beforeEnter: (to, from, next) => {
//             finance_procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/request-approvals",
//         component: RequestApprovals,
//         name: "RequestApprovals",
//         // beforeEnter: (to, from, next) => {
//         //     finance_procurement_access.includes(auth.userAccess) == true
//         //         ? next()
//         //         : next({ name: "ForbiddenPage" });
//         // }
//     },
//     {
//         path: "/d/supplier-approvals/review/:id",
//         component: ReviewSupplier,
//         name: "ReviewSupplier",
//         beforeEnter: (to, from, next) => {
//             finance_procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },

//     {
//         path: "/d/request-approvals/prf/:id",
//         component: viewRequisition,
//         name: "prf-approval",
//         // beforeEnter: (to, from, next) => {
//         //     finance_procurement_access.includes(auth.userAccess) == true
//         //         ? next()
//         //         : next({ name: "ForbiddenPage" });
//         // }
//     },
//     {
//         path: "/d/procurement-prf-list/s/:id",
//         component: viewPrfProcurement,
//         name: "procurement-approval",
//         beforeEnter: (to, from, next) => {
//             procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },

//     {
//         path: "/d/view-prf/s/:id",
//         component: viewPrfProcurement,
//         name: "view-prf",
//         beforeEnter: (to, from, next) => {
//             finance_procurement_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },

//     /**
//      * Supplier Pages
//      */
//     {
//         path: "/d/item-requests",
//         component: ItemRequests,
//         name: "ItemRequests",
//         beforeEnter: (to, from, next) => {
//             supplier_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/my-quotations",
//         component: Quotations,
//         name: "Quotations",
//         beforeEnter: (to, from, next) => {
//             supplier_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/:model/:id",
//         component: SingleQuotation,
//         name: "single-quotation",
//         props: true,

//     },
//     {
//         path: "/d/view/quotation/:id",
//         component: SingleQuotation,
//         name: "view-single-quotation",
//         props: true,
//         beforeEnter: (to, from, next) => {
//             all_access.includes(auth.userAccess) == true
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/supplier/profile", // to delete
//         component: SupplierProfile,
//         name: "SupplierProfile"
//     },

//     /**
//      * Admin Pages
//      */
//     {
//         path: "/d/users",
//         component: Users,
//         name: "users",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/users/new",
//         component: NewUser,
//         name: "NewUser",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/users/edit/:id",
//         component: EditUser,
//         name: "EditUser",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/settings/approval/stages",
//         component: ApprovalStages,
//         name: "ApprovalStages",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/general-settings",
//         component: Settings,
//         name: "general-settings",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/companies",
//         component: Companies,
//         name: "companies",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/departments",
//         component: Departments,
//         name: "departments",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/departments/page/:page",
//         component: Departments,
//         name: "departments-page",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     },
//     {
//         path: "/d/supplier-approval",
//         component: SuppApproval,
//         name: "supplier-approvals",
//         beforeEnter: (to, from, next) => {
//             auth.userObject.role == "admin"
//                 ? next()
//                 : next({ name: "ForbiddenPage" });
//         }
//     }
// ];
