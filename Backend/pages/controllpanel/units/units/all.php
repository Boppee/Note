<script type="text/javascript">

const tr = ({id, name, short, description, nr}) => `
<tr value="${nr}" class="itemsRow" id="units${id}">
  <td></td>
  <td class="name search contenteditable" id="name${id}">${name}</td>
  <td class="short contenteditable" id="short${id}">${short}</td>
  <td class="description contenteditable" id="description${id}">${description}</td>
  <td class="cbp${id} edittoggle"><input type="checkbox" id="cbpinput${id}" value=""></td>
  <?php if ($session->checkPrem("modify", $up)) {
    ?><td class=""><a href="" class="editclick toggle${id}" id="edit${id}" onclick='event.preventDefault()'><i class="fas fa-edit"></i><a href="" class="saveclick toggle${id}" id="edit${id}" onclick='event.preventDefault()'><i class="fas fa-check"></i></td><?php
  } ?>
  <?php if ($session->checkPrem("delete", $up)) {
    ?><td class="remove"><a href="" class="removeclick" id="remove${id}" onclick='event.preventDefault();removeunit(event, page)'><i class="fas fa-trash-alt"></i></a></td><?php
  } ?>
</tr>
`;
</script>
<thead id="listhead">
  <tr>
    <th class="pc"></th>
    <th>Unit</th>
    <th class="smalltd">Shorting</th>
    <th>Description</th>
    <th class="smalltd">Can be per</th>
    <th class="pc"></th>
  </tr>
</thead>
<div class="">
  <tbody id="listTab">


  </tbody>
</div>
<script src="script/pages/list/pageSystem.js" charset="utf-8"></script>
<script src="script/pages/units/units/showAll.js" charset="utf-8"></script>
