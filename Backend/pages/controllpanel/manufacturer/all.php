<script type="text/javascript">

const tr = ({id, name, country, website, nr}) => `
<tr value="${nr}" class="itemsRow" id="man${id}">
  <td class="name search" id="name${id}">${name}</td>
  <td class="country" id="country${id}">${country}</td>
  <td class="website" id="website${id}"><a href="${website}">${website}</a></td>
  <?php if ($session->checkPrem("modify", $up)) {
    ?><td class=""><a href="?page=list&underpage=manufacturer&id=${id}" ><i class="fas fa-edit"></i></a></td><?php
  } ?>
</tr>
`;

</script>
<thead id="listhead">
  <tr>
    <th>Name</th>
    <th>country</th>
    <th>Website</th>
    <th class="pc"></th>
  </tr>
</thead>
<tbody id="listTab">

</tbody>
<script src="script/pages/manufacturer/create.js" charset="utf-8"></script>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
<script src="script/pages/manufacturer/showAll.js" charset="utf-8"></script>
<link rel="stylesheet" href="css/page/man.css">
