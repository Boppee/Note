<link rel="stylesheet" href="css/page/accounts.css">
<script src="script/pages/accounts/displayaccounts.js" charset="utf-8"></script>
<main>
  <div class="inner">
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
      </thead>
      <tbody id="accountab">
        
      </tbody>
    </table>
    <div id="footeraccount">
      <div id="leftbutton" class="buttonaccounts">
        <p id="prevpage"><i class="fas fa-angle-left"></i> Previous page</p>
      </div>
      <div id="centertext">

      </div>
      <div id="rightbutton" class="buttonaccounts">
        <p id="nextpage">Next Page <i class="fas fa-angle-right"></i></p>
      </div>
    </div>
  </div>
</main>
