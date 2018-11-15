<script src="../../jquery.js" charset="utf-8"></script>
<script src="script/pages/accounts/displayaccounts.js" charset="utf-8"></script>
<main>
  <form id="accountFilter">
    <input type="text" id="searchbar" placeholder="Search">
    <input type="checkbox" name="" value="">
    <div id="permissions">
      <input type="checkbox" name="" value="">
      <input type="checkbox" name="" value="">
      <input type="checkbox" name="" value="">
    </div>
    <select id="numberofAcoounts">

    </select>
  </form>
  <table>
    <thead>
      <th>ID</th>
      <th>Active</th>
      <th>Username</th>
      <th>Last Logon</th>
      <th>Pages</th>
      <div id="extendedPages">
        <th>Dashboard</th>
        <th>Orders</th>
        <th>Accounts</th>
      </div>
      <th>Permission</th>
      <div id="extendedPermission">
        <th>Login</th>
        <th>Manage Accounts</th>
      </div>
    </thead>
    <tbody id="accountab">

    </tbody>
    <tfoot>

    </tfoot>
  </table>
</main>
