<link rel="stylesheet" href="css/page/accounts.css">
<script src="script/pages/accounts/displayaccounts.js" charset="utf-8"></script>
<main>
  <div class="inner">
    <form id="accountFilter">
      <select id="numberofAcoounts">

      </select>
      <input type="text" id="searchTable" placeholder="Serach by username">
    </form>
    <div id="footeraccount">
      <div id="leftbutton" class="buttonaccounts">
        <button id="prevpage"><i class="fas fa-angle-left"></i> Previous page</button>
      </div>
      <div id="centertext">

      </div>
      <div id="rightbutton" class="buttonaccounts">
        <button id="nextpage">Next Page <i class="fas fa-angle-right"></i></button>
      </div>
    </div>
    <table id="accountTable">
      <thead id="accounthead">
        <tr>
          <th>Active</th>
          <th>Username</th>
          <th>Last Logon</th>

          <th>dashboard</th>
          <th>accounts</th>
          <th>orders</th>
          <th>products</th>
          <th>categories</th>
          <th>statistics</th>
          <th>Go to Profile</th>
        </tr>
      </thead>
      <tbody id="accountab">

      </tbody>
    </table>
  </div>
</main>
