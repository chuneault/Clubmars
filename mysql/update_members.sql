update members, members_juin_2015 
set members.address = members_juin_2015.address,
members.birth_date = members_juin_2015.birth_date,
members.cell_phone = members_juin_2015.cell_phone,
members.city = members_juin_2015.city,
members.email = members_juin_2015.email,
members.first_name = members_juin_2015.first_name,
members.last_name = members_juin_2015.last_name,
members.member_since = members_juin_2015.member_since,
members.postal_code = members_juin_2015.postal_code,
members.public_cell_phone = members_juin_2015.public_cell_phone,
members.public_email = members_juin_2015.public_email,
members.public_home_phone = members_juin_2015.public_home_phone,
members.last_update = '2015/06/16'
where members.maac = members_juin_2015.maac

----

delete from members_juin_2015 where maac in (select maac from members)
----

delete from members WHERE last_update < '2015/06/16' or  last_update is null
----

insert into members (address, birth_date, cell_phone, city, email, first_name, last_name, member_since, postal_code, public_cell_phone, public_email, public_home_phone, maac)
(select address, birth_date, cell_phone, city, email, first_name, last_name, member_since, postal_code, public_cell_phone, public_email, public_home_phone, maac from members_juin_2015)

----

update members set member_username = maac, password = maac where member_username = ''

