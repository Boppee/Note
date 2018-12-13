<script src="script/pages/accounts/displayaccounts.js" charset="utf-8"></script>
<div id="footeraccount">
  <div id="spacer">
    <div id="leftbutton" class="buttonaccounts">
      <button id="prevpage"><i class="fas fa-angle-left"></i> Previous page</button>
    </div>
    <div id="centertext">

    </div>
    <div id="rightbutton" class="buttonaccounts">
      <button id="nextpage">Next Page <i class="fas fa-angle-right"></i></button>
    </div>
  </div>
</div>
<div class="search">
  <input type="text" id="searchTable" placeholder="Serach by username">
</div>
<div class="overflowscroll">
  <table id="accountTable">
    <thead id="accounthead">
      <tr>
        <th>Active</th>
        <th>Username</th>
        <th>Last Logon</th>

        <th>Accounts</th>
        <th>Orders</th>
        <th>Products</th>
        <th>Categories</th>
        <th>Statistics</th>
        <th>Go to Profile</th>
      </tr>
    </thead>
    <tbody id="accountab">

    </tbody>
  </table>
</div>
<div class="accpp">
  <p>Accounts per page <select id="numberofAcoounts"></select></p>
</div>
