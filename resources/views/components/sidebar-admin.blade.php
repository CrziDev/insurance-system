<x-nav-link href="/admin/dashboard" :active="request()->is('admin/dashboard')">Dashboard</x-nav-link>
<x-nav-link href="/admin/transactions" :active="request()->is('admin/transactions')">Transactions</x-nav-link>
<x-nav-link href="/admin/customers" :active="request()->is('admin/customers')">Customers</x-nav-link>
<x-nav-link href="/admin/staff" :active="request()->is('admin/staff')">Staff</x-nav-link>
<x-nav-link href="/admin/policies" :active="request()->is('admin/policies')">Policies</x-nav-link>
<x-nav-link href="/admin/claims" :active="request()->is('admin/claims')">Claims</x-nav-link>
<x-nav-link href="/admin/reports" :active="request()->is('admin/reports')">Reports</x-nav-link>