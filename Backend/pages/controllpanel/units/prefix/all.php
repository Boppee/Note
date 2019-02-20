<script type="text/javascript">

const tr = ({id, name, short, base, exponent, nr}) => `
<tr value="${nr}" class="itemsRow" id="prefix${id}">
  <td></td>
  <td class="name search contenteditable">${name}</td>
  <td class="short contenteditable">${short}</td>
  <td class="base contenteditable">${base}</td>
  <td class="exponent contenteditable">${exponent}</td>
  <?php if ($session->checkPrem("modify", $up)) {
    ?><td class="edit"><a href="" class="editclick" id="edit${id}" onclick='event.preventDefault()'><i class="fas fa-edit"></i></td><?php
  } ?>
  <?php if ($session->checkPrem("delete", $up)) {
    ?><td class="remove"><a href="" class="removeclick" id="remove${id}" onclick='event.preventDefault()'><i class="fas fa-trash-alt"></i></a></td><?php
  } ?>
</tr>
`;

</script>
<thead id="listhead">
  <tr>
    <td class="pc"></td>
    <th>Prefix</th>
    <th>Shorting</th>
    <th>Base</th>
    <th class="pc">Exponent</th>
    <td class="pc"></td>
  </tr>
</thead>
<tbody id="listTab">

</tbody>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
<script src="script/pages/units/prefix/showAll.js" charset="utf-8"></script>
