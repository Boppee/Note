<script type="text/javascript">

const tr = ({id, name, price, nr, stock}) => `
<tr value="${nr}" class="itemsRow" id="product${id}">
  <td class="vis${id} visibleTd"><input id="test" class="vis${id} visibleInput" type="checkbox"></td>
  <td class="name search">${name}</td>
  <td class="stock">${stock}</td>
  <td class="price">${price}</td>
  <td class="gotoprofile"><a href="?page=list&underpage=products&id=${id}">Profile</a></td>
</tr>
`;

</script>
<thead id="listhead">
  <tr>
    <th>Visible</th>
    <th>Product name</th>
    <th>Stock</th>
    <th>Price</th>
    <th>Go to product</th>
  </tr>
</thead>
<tbody id="listTab">

</tbody>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
