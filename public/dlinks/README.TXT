1. ����� data ������ ���� �������� ��� ������. ����� 666.
2. ��������� � gconfig.php

# ���������� ���������:

������� ��� ������:
cConfigSm::instance('global_template1', '<a href="{url}"><img src="{img_url}" alt="" /><br />{text}</a><br />{comment}');
cConfigSm::instance('global_template2', '<a href="{url}"><img src="{img_url}" alt="" /><br />{text}</a><br />{comment}');
cConfigSm::instance('global_template3', '<a href="{url}"><img src="{img_url}" alt="" /><br />{text}</a><br />{comment}');
����� ������� �������������� ���������� ��������� ��������

��������� ��������� � �������: {img},{img_url},{url},{text},{comment}
{img} - ������������� <img src="{img_url">, ���� �������� � ���������� ����������. ������ ���� ���� ������������� �������� �����������. ���� � ������ ��� �����������, ��������� ������ ������
{img_url} - url � ������������ ������, ���� �������� � ���������� ����������. ���� � ������ ��� ����������� (�� �������� ����� ������������), ����� ���������� �������� �� cConfigSm::instance('global_default_img')
{url} - url ������
{text} - ����� ������
{comment} - html ����������� � ������ ������ ������

cConfigSm::instance('global_show_img', 1);
��������� 1, ���� ����� �������������� �����������. ���� 0, �� � {img_url} ����� ���������� cConfigSm::instance('global_default_img'), � � {img} ������ ������.
����� ����� ��������� ���������� ��������� scron.php, ����� ����������� ����.

cConfigSm::instance('global_session_id', '/search=,sid=,/admin/,ref=,utm_');
������������� ������ ��� ������ � URL, ��� ������� �� ����� ������������ �������������� ������. �� ����� ��������� ��������� �����-������������� (��. ����). ����� ��������� ��������� �������� ����� �������. ���������������, �.�. utm_ � UTM_ �� ���� � �� ��.
���� ����� ���������� ������� � URL, ����������� �: \,
����� �������� ������.

cConfigSm::instance('global_db2_files', 10);
��� ������ ���������� ���������� ������� ���������� 1. �� ������� ������� ������ ������, ������ ��������������!
���������� 1 ��� 50� ������� �����.

//cConfigSm::instance('global_utf8', '1'); ����� � utf8
���� ����� ����� �� ����� � utf, ��������������� ��� �������

# ����������� ���������, ������ ������:

cConfigSm::instance('global_default_anchor', 'http://www.sotmarket.ru/category/photo.html');
URL ������������� ������, ��� �� ��������� � ������ ������ ������ ��������������.

cConfigSm::instance('global_default_text', '��� ������������ � ��������-�������� ���������');
����� ������������� ������.

cConfigSm::instance('global_url', 'http://www.sotmarket.ru/product/');
����� URL � ��������� ������ ����������.

cConfigSm::instance('global_img_url', 'http://img.sotmarket.ru/resized/');
����� URL � ��������� ����������.

cConfigSm::instance('global_default_img', 'http://www.sotmarket.ru/d/i/b-nophoto_label.png');
url ��������-�������� � ������ ���������� ��������� ����������� ������.

3. ����� ������ �������� ���� ��������� scron.php
���� scron.php ����� ��������� � ���� � ��������� ��� ��� � ��� ����.

� ������ ����� global_show_img, ����� ���������� ��������� scron.php
�� ������������ ����� � db2. ��������� ���������. ������������� ����������.

4. ����������� �� ��������.

require_once('slibs/cKeysDb.php');
// ��� $sUrl  ��� �������� ��� ������� ������������ ����. �������� $_SERVER['REQUEST_URI']
// � ������� ������ ������ ���������� ��������� ����� �������. 
echo cKeysDb::getBlock($sUrl,2);