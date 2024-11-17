<x-nav-link href="/staff/dashboard" :active="request()->is('staff/dashboard')">Dashboard</x-nav-link>
<x-nav-link href="/staff/request" :active="request()->is('staff/request')">Request</x-nav-link>
<x-nav-link href="/staff/expiring" :active="request()->is('staff/expiring')">Expiring</x-nav-link>
<x-nav-link href="/staff/customers" :active="request()->is('staff/customers')">Customers</x-nav-link>
<!-- <x-nav-link href="/staff/staff" :active="request()->is('staff/staff')">Staff</x-nav-link> -->
<x-nav-link href="/staff/policies" :active="request()->is('staff/policies')">Policies</x-nav-link>
<x-nav-link href="/staff/claims" :active="request()->is('staff/claims')">Claims</x-nav-link>
<x-nav-link href="/staff/reports" :active="request()->is('staff/reports')">Reports</x-nav-link>