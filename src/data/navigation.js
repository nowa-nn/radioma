export const catalogPages = [
  {
    id: 'radiocenters',
    title: 'Строительство радиоцентров',
    fullTitle: 'Проектирование и строительство радиоцентров',
    path: '/catalog/radiocenters',
    shortDesc: 'Комплекс изыскательских, проектных и строительно-монтажных работ радиовещательных и связных объектов «под ключ».',
    image: '/images/slide-radiocenters.jpg',
    code: 'EPC / СТРОИТЕЛЬСТВО'
  },
  {
    id: 'navigation-monitoring',
    title: 'Навигация и мониторинг',
    fullTitle: 'Системы и оборудование навигации и мониторинга транспортных средств («РАДИОМА Трафик»)',
    path: '/catalog/navigation-monitoring',
    shortDesc: 'Спутниковый ГЛОНАСС/GPS контроль и телематика транспорта там, где заканчивается наземная инфраструктура.',
    image: '/images/remote-fleet.jpg',
    code: 'РАДИОМА ТРАФИК'
  },
  {
    id: 'trunking',
    title: 'Транкинговая радиосвязь',
    fullTitle: 'Оборудование и системы транкинговой радиосвязи',
    path: '/catalog/trunking',
    shortDesc: 'Профессиональные ведомственные и технологические цифровые транкинговые сети стандартов DMR и TETRA.',
    image: '/images/trunking.jpg',
    code: 'DMR / TETRA'
  },
  {
    id: 'antennas',
    title: 'Антенны и АФУ',
    fullTitle: 'Антенны и антенные системы специального исполнения',
    path: '/catalog/antennas',
    shortDesc: 'Стационарные, морские и широкополосные КВ/УКВ антенно-фидерные устройства для жестких условий эксплуатации.',
    image: '/images/antennas.jpg',
    code: 'АФУ / АНТЕННЫ'
  },
  {
    id: 'suds-ais',
    title: 'Оборудование СУДС — АИС',
    fullTitle: 'Оборудование систем управления движения судов (СУДС — АИС)',
    path: '/catalog/suds-ais',
    shortDesc: 'Лоцманские комплексы АИС «Тритон-92Л», береговые станции АИС «Тритон-92С», транспондеры и ретрансляторы.',
    image: '/images/slide-suds-ais.jpg',
    code: 'СУДС / АИС'
  },
  {
    id: 'gmssb',
    title: 'Системы ГМССБ',
    fullTitle: 'Системы глобальной морской связи при бедствии для обеспечения безопасности мореплавания (ГМССБ)',
    path: '/catalog/gmssb',
    shortDesc: 'Береговые и судовые комплексы связи аварийного оповещения, ЦИВ, НАВТЕКС и спутниковые системы.',
    image: '/images/slide-gmssb.jpg',
    code: 'ГМССБ / GMDSS'
  },
  {
    id: 'marine-radio',
    title: 'Радиостанции для флота',
    fullTitle: 'Радиостанции для морского и речного флота',
    path: '/catalog/marine-radio',
    shortDesc: 'Стационарные, судовые и носимые радиостанции морского (УКВ/КВ) и речного диапазонов марок «РАДИОМА» и «САНТЕЙ МОБАЙЛ».',
    image: '/images/slide-marine-radio.jpg',
    code: 'РАДИОСТАНЦИИ'
  },
  {
    id: 'maintenance',
    title: 'Техобслуживание и ремонт',
    fullTitle: 'Техническое обслуживание и ремонт техники связи',
    path: '/catalog/maintenance',
    shortDesc: 'Регламентное ТО, восстановительный ремонт на компонентном уровне, поверка, калибровка и склад ЗИП.',
    image: '/images/service-lab.jpg',
    code: 'СЕРВИСНЫЙ ЦЕНТР'
  }
]

export const navLinks = [
  { name: 'Главная', path: '/' },
  { name: 'О компании', path: '/about' },
  { 
    name: 'Каталог систем и оборудования', 
    path: '/#catalog',
    children: catalogPages 
  },
  { name: 'Инжиниринг и строительство', path: '/engineering' },
  { name: 'Сервисный центр', path: '/service' },
  { name: 'Новости', path: '/news' },
  { name: 'Сертификаты', path: '/certificates' },
  { name: 'Контакты', path: '/contacts' }
]

export const companyContacts = {
  fullName: 'ООО «Радиома оборудование связи и навигации»',
  shortName: 'ООО «Радиома»',
  brandName: 'РАДИОМА',
  tagline: 'Связь там, где заканчивается наземная инфраструктура',
  subTagline: 'Отечественный разработчик и производитель систем радиосвязи и навигации с 1995 года',
  phone: '(495) 725-60-06',
  phoneRaw: '+74957256006',
  tollFreePhone: '8 (800) 725-60-06',
  tollFreePhoneRaw: '+78007256006',
  fax: '(495) 725-60-08',
  email: 'office@radioma.ru',
  workHours: 'Понедельник — пятница: с 09:00 до 18:00 (МСК)',
  weekend: 'Суббота, воскресенье: выходные дни',
  address: '123104, г. Москва, ул. Малая Бронная, д. 2, стр. 1',
  regionCenters: [
    { city: 'Москва', desc: 'Центральный офис и НТЦ' },
    { city: 'Санкт-Петербург', desc: 'Филиал морского радиооборудования' },
    { city: 'Владивосток', desc: 'Сервисный центр Дальневосточного бассейна' },
    { city: 'Мурманск', desc: 'Представительство систем связи Севморпути' }
  ],
  yearFounded: 1995,
  brands: ['РАДИОМА', 'САНТЕЙ МОБАЙЛ', 'РАДИОМА Трафик']
}
