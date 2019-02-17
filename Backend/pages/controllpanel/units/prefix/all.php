<script type="text/javascript">

const tr = ({id, name, short, base, exponent, nr}) => `
<tr value="${nr}" class="itemsRow" id="prefix${id}">
  <td class="name">${name}</td>
  <td class="short">${short}</td>
  <td class="base">${base}</td>
  <td class="exponent">${exponent}</td>
  <td class="gotoprefix"><a href="?page=list&underpage=units&prefix&id=${id}">prefix</a></td>
  <?php if ($session->checkPrem("delete", $up)) {
    ?><td class="remove"><a href="" class="removeclick" id="remove${id}" onclick='event.preventDefault();removeunit(event, page)'><i class="fas fa-trash-alt"></i></a></td><?php
  } ?>
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
