<script type="text/javascript">

const tr = ({id, name, short, base, exponent, nr}) => `
<tr value="${nr}" class="itemsRow" id="Unit${id}">
  <td class="name">${name}</td>
  <td class="short">${short}</td>
  <td class="base">${base}</td>
  <td class="exponent">${exponent}</td>
  <td class="gotounit"><a href="?page=list&underpage=units&prefix&id=${id}">Unit</a></td>
</tr>
`;

</script>
<thead id="listhead">
  <tr>
    <th>Prefix</th>
    <th>Shorting</th>
    <th>Base</th>
    <th>Exponent</th>
    <th>Visit</th>
  </tr>
</thead>
<tbody id="listTab">

</tbody>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
<script src="script/pages/units/prefix/showAll.js" charset="utf-8"></script>
