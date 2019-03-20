<script type="text/javascript">

const tr = ({id, newsid, nname, pname, pid, nr}) => `
<tr value="${nr}" class="itemsRow" id="product${id}">
  <td class="vis${id} visibleTd"><input id="test" class="vis${id} visibleInput" type="checkbox"></td>
  <td class="product search"><a href="?page=list&underpage=products&id=${pid}">${pname}</a></td>
  <td class="news"><a href="?page=list&underpage=news&id=${newsid}">${nname}</a></td>
  <td class="gotoprofile"><a href="?page=list&underpage=promotions&id=${id}">Promotion</a></td>
</tr>
`;

</script>
<thead id="listhead">

  <tr>
    <th>Visible</th>
    <th>Product</th>
    <th>News</th>
    <th>Go to promotion</th>
  </tr>
</thead>
<tbody id="listTab">

</tbody>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
<script src="script/pages/promotions/showAllNews.js" charset="utf-8"></script>
