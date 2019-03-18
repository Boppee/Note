<script type="text/javascript">

const tr = ({id, name, desc, nr}) => `
<tr value="${nr}" class="itemsRow" id="product${id}">
  <td class="vis${id} visibleTd"><input id="test" class="vis${id} visibleInput" type="checkbox"></td>
  <td class="name search">${name}</td>
  <td class="stock">${desc}</td>
  <td class="gotoprofile"><a href="?page=list&underpage=news&id=${id}">Article</a></td>
</tr>
`;

</script>
<thead id="listhead">
  <tr>
    <th>Visible</th>
    <th>Name</th>
    <th>Description</th>
    <th>Go to news article</th>
  </tr>
</thead>
<tbody id="listTab">

</tbody>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
<script src="script/pages/news/showAllNews.js" charset="utf-8"></script>
