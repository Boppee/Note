<script type="text/javascript">

const tr = ({id, name, short, description, nr}) => `
<tr value="${nr}" class="itemsRow" id="Unit${id}">
  <td class="name">${name}</td>
  <td class="short">${short}</td>
  <td class="cbp${id}"><input type="checkbox" name="" value=""></td>
  <td class="description">${description}</td>
  <td class="gotounit"><a href="?page=list&underpage=units&units&id=${id}">Unit</a></td>
</tr>
`;

</script>
<thead id="listhead">
  <tr>
    <th>Unit</th>
    <th>Shorting</th>
    <th>Description</th>
    <th>Can be per</th>
    <th>Visit</th>
  </tr>
</thead>
<tbody id="listTab">

</tbody>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
<script src="script/pages/units/units/showAll.js" charset="utf-8"></script>
