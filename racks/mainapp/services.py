from django.db import models
from .models import (
    Region, 
    Department, 
    Site, 
    Building, 
    Room, 
    Rack, 
    Device,
)


def _regions():
    """
    Все регионы
    """
    return Region.objects.all()


def _departments():
    """
    Все отделы
    """
    return Department.objects.all()


def _sites():
    """
    Все объекты
    """
    return Site.objects.all()


def _buildings():
    """
    Все здания
    """
    return Building.objects.all()


def _rooms():
    """
    Все помещения
    """
    return Room.objects.all()


def _racks():
    """
    Все стойки
    """
    return Rack.objects.all()


def _device(pk):
    """
    Устройство
    """
    return Device.objects.get(id=pk)


def _rack(pk):
    """
    Стойка
    """
    return Rack.objects.get(id=pk)


def _direction(pk):
    """
    Направление нумерации стойки
    """
    return Rack.objects.get(id=pk).numbering_from_bottom_to_top


def _devices(pk, side):
    """
    Устройства в стойке для указанной стороны
    """
    return Device.objects.filter(rack_id_id=pk) \
                                 .filter(frontside_location=side)


def _rack_id(pk):
    """
    ID стойки
    """
    return Device.objects.get(id=pk).rack_id_id


def _rack_name(pk):
    """
    Наименование стойки
    """
    return Rack.objects.get(id=pk).rack_name       


def _start_list(pk, direction):
    """
    Список юнитов (всего)
    Для отрисовки стоек
    """
    if direction == False:
        return list(range(1, (int(Rack.objects.get(id=pk) \
                .rack_amount) + 1)))
    else:
        return list(range(1, (int(Rack.objects.get(id=pk) \
                .rack_amount) + 1)))[::-1]


def _first_units(pk, direction, side):
    """
    Первые юниты по порядку для каждого устройства 
    в зависимости от напрвления нумерации
    Для отрисовки стоек
    """
    first_units = {}
    queryset_spans = Device.objects.filter(rack_id_id=pk) \
                                   .filter(frontside_location=side)
    for span in queryset_spans:
        last_unit = span.last_unit
        first_unit = span.first_unit
        if direction == True:
            if last_unit > first_unit:
                first_unit = span.last_unit
            first_units[span.id] = first_unit
        else:
            if last_unit < first_unit:
                first_unit = sapn.last_unit
            first_units[span.id] = first_unit
    return first_units


def _spans(pk, side):
    """
    Роуспаны для каждого устройства (устройства шириной более одного юнита)
    Для отрисовки стоек
    """
    spans = {}
    queryset_spans = Device.objects.filter(rack_id_id=pk) \
                                   .filter(frontside_location=side)
    for span in queryset_spans:
        last_unit = span.last_unit
        first_unit = span.first_unit
        if last_unit < first_unit:
            first_unit = span.last_unit
            last_unit = span.first_unit
        spans[span.id] = last_unit - first_unit + 1
    return spans


def _group_check(user_groups, pk, model):
    """
    Проверка есть ли в списке групп пользователя группа 
    с наминованием отдела совпадающая с принадлежностью объекта модели к 
    зоне ответственности отдела по первичным ключам 
                                                          __
                                              ======      \/
    _____________ _____________ _____________ | [] |=========
    \  костыли  / \  костыли  / \  костыли  / |              )
     ===========   ===========   ===========  ================
     O-O     O-O   O-O     O-O   O-O     O-O  O-O-O   O-O-O \\

    Не дает изменять данные закрепленые за другим отделом
    """
    if model == Department:
        department_raw_query = Department.objects.raw("""select department.id as id,
                                                      department.department_name 
                                                      from department 
                                                      where 
                                                      department.id='""" + 
                                                      str(pk) + 
                                                      """';""")
    elif model == Site:
        department_raw_query = Department.objects.raw("""select department.id as id, 
                                                      department.department_name 
                                                      from site 
                                                      join department on 
                                                      department.id = 
                                                      site.department_id_id 
                                                      where 
                                                      site.id='""" + 
                                                      str(pk) + 
                                                      """';""")
    elif model == Building:
        department_raw_query = Department.objects.raw("""select department.id as id, 
                                                      department.department_name 
                                                      from building 
                                                      join site on 
                                                      site.id = building.site_id_id 
                                                      join department on 
                                                      department.id = 
                                                      site.department_id_id 
                                                      where 
                                                      building.id='""" + 
                                                      str(pk) + 
                                                      """';""")
    elif model == Room:
        department_raw_query = Department.objects.raw("""select department.id as id, 
                                                      department.department_name 
                                                      from room
                                                      join building on 
                                                      building.id = 
                                                      room.building_id_id  
                                                      join site on 
                                                      site.id = 
                                                      building.site_id_id
                                                      join department on 
                                                      department.id = 
                                                      site.department_id_id 
                                                      where 
                                                      room.id='""" + 
                                                      str(pk) + 
                                                      """';""")
    elif model == Rack:
        department_raw_query = Department.objects.raw("""select department.id as id, 
                                                      department.department_name 
                                                      from rack
                                                      join room on 
                                                      room.id = 
                                                      rack.room_id_id 
                                                      join building on 
                                                      building.id = 
                                                      room.building_id_id  
                                                      join site on 
                                                      site.id = 
                                                      building.site_id_id
                                                      join department on 
                                                      department.id = 
                                                      site.department_id_id 
                                                      where 
                                                      rack.id='""" + 
                                                      str(pk) + 
                                                      """';""")
    elif model == Device:
        department_raw_query = Department.objects.raw("""select department.id as id, 
                                                      department.department_name 
                                                      from device
                                                      join rack on 
                                                      rack.id = 
                                                      device.rack_id_id
                                                      join room on 
                                                      room.id = 
                                                      rack.room_id_id 
                                                      join building on 
                                                      building.id = 
                                                      room.building_id_id  
                                                      join site on 
                                                      site.id = 
                                                      building.site_id_id
                                                      join department on 
                                                      department.id = 
                                                      site.department_id_id 
                                                      where 
                                                      device.id='""" + 
                                                      str(pk) + 
                                                      """';""")
    department_name = str([department_name for department_name in department_raw_query][0])
    if department_name in user_groups:
        return True


def _old_units(pk):
    """
    Уже заполненные юниты
    Для перемещения устройства в стойке
    """
    units = {}
    first_unit = Device.objects.get(id=pk).first_unit
    last_unit = Device.objects.get(id=pk).last_unit
    units['old_first_unit'] = first_unit
    units['old_last_unit'] = last_unit
    if units['old_first_unit'] > units['old_last_unit']:
        units['old_last_unit'] = first_unit
        units['old_first_unit'] = last_unit
    return units


def _new_units(first_unit, last_unit):
    """
    Юниты для вновь добавляемого устройства
    """
    units= {}
    units['new_first_unit'] = first_unit
    units['new_last_unit'] = last_unit
    if units['new_first_unit'] > units['new_last_unit']:
        units['new_last_unit'] = first_unit
        units['new_first_unit'] = last_unit  
    return units


def _all_units(pk):
    """
    Всего юнитов в стойке
    """
    units = {}
    units['all_units'] = Rack.objects.get(id=pk).rack_amount
    return units
    

def _unit_exist_check(units, pk):
    """
    Есть ли вообще такие юниты (болше или меньше указанного)?
    """
    if not set(range(units['new_first_unit'], units['new_last_unit'] + 1)) \
        .issubset(range(1, units['all_units'] + 1)):
        return True

        
def _unit_busy_check(location, units, pk, update):
    """
    Заняты ли юниты (добавление, перемещение устройства)?
    """
    filled_list = []
    queryset_devices = Device.objects.filter(rack_id_id=pk) \
                .filter(frontside_location=location)
    if len(list(queryset_devices)) > 0:
        for device in queryset_devices:
            first_unit = device.first_unit
            last_unit = device.last_unit
            if first_unit > last_unit:
                first_unit = device.last_unit
                last_unit = device.first_unit
            one_device_list = list(range(first_unit, last_unit + 1))
            filled_list.extend(one_device_list)
    if update == True:
        filled_list = set(filled_list) - set(range(units['old_first_unit'], 
                                                   units['old_last_unit'] + 1))
    if any(unit in set(range(units['new_first_unit'], 
           units['new_last_unit'] + 1)) for unit in filled_list):
        return True


def _unique_list(pk, model):
    """
    Чтобы наименования зданий помещений и стоек могли повторяться 
    в рамках зоны ответственности одного отдела
    """
    if model == Site:
        return [building.building_name for building 
                in Building.objects.filter(site_id_id=pk)]
    elif model == Building:
        return [room.room_name for room 
                in Room.objects.filter(building_id_id=pk)]
    elif model == Room:
        return [rack.rack_name for rack 
                in Rack.objects.filter(room_id_id=pk)]


def _device_stack(device_link, device_stack):
    """
    Стековое устройство
    Для отчета по устройствам
    """
    if device_stack != None:
        return device_link + str(device_stack)
    else:
        return None


def _frontside_location(frontside_location):
    """
    Расположение
    Для отчета по устройствам
    """
    if frontside_location == True:
        return 'Да'
    else:
        return 'Нет'


def _numbering(numbering):
    """
    Нумерация
    Для отчета по стойкам
    """
    if numbering == True:
        return 'Да'
    else:
        return 'Нет'


def _external_ups(external_ups):
    """
    Наличие бесперебойника
    Для отчета по стойкам
    """
    if external_ups == True:
        return 'Да'
    else:
        return 'Нет'


def _cooler(cooler):
    """
    Наличие вентиляции
    Для отчета по стойкам
    """
    if cooler == True:
        return 'Да'
    else:
        return 'Нет'


def _header(pk):
    """
    Набор данных для шапки стойки (местонахождение)
    """
    return Rack.objects.raw("""select rack.id as id, 
                            rack.rack_name,
                            room.room_name, 
                            building.building_name, 
                            site.site_name, 
                            department.department_name, 
                            region.region_name 
                            from rack 
                            join room on 
                            room.id = 
                            rack.room_id_id 
                            join building on 
                            building.id = 
                            room.building_id_id 
                            join site on 
                            site.id = 
                            building.site_id_id 
                            join department on 
                            department.id = 
                            site.department_id_id 
                            join region on 
                            region.id = 
                            department.region_id_id 
                            where 
                            rack.id='""" + 
                            str(pk) + 
                            """';""")


def _side_name(side):
    """
    Указание стороны для черновика
    """
    if side == 'True':
        return 'Фронтальная сторона стойки'
    else:
        return 'Тыльная сторона стойки'


def _font_size(rack_size):
    """
    Размер шрифта для черновика
    """
    if rack_size <= 32: 
        return '100'
    elif rack_size > 32 and rack_size <= 42:
        return '75'
    else:  
        return '50'
