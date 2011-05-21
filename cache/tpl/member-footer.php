<?php defined('IN_DESTOON') or exit('Access Denied');?></td>
</tr>
</table>
<script type="text/javascript">
if(document.body.clientHeight-85 > $('main').scrollHeight) $('main').style.height=(document.body.clientHeight-85)+'px';
<?php if($_message) { ?>document.write(sound('message'));<?php } ?>
</script>
<?php include template('stats', 'chip');?>
</body>
</html>