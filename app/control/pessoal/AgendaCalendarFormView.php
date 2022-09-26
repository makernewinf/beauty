<?php
/**
 * AgendaCalendarForm Form
 * @author  <your name here>
 */
class AgendaCalendarFormView extends TPage
{
    private $fc;

    /**
     * Page constructor
     */
    public function __construct($param = null)
    {
        parent::__construct();

        TSession::setValue(__CLASS__.'load_filter_profissionais_id', null);

        $this->fc = new TFullCalendar(date('Y-m-d'), 'month');
        $this->fc->enableDays([1,2,3,4,5,6]);
        $this->fc->setReloadAction(new TAction(array($this, 'getEvents'), $param));
        $this->fc->setDayClickAction(new TAction(array('AgendaCalendarForm', 'onStartEdit')));
        $this->fc->setEventClickAction(new TAction(array('AgendaCalendarForm', 'onEdit')));
        $this->fc->setEventUpdateAction(new TAction(array('AgendaCalendarForm', 'onUpdateEvent')));
        $this->fc->setCurrentView('agendaWeek');
        $this->fc->setTimeRange('08:00', '19:00');
        $this->fc->enablePopover('Cliente:', " {clientes->nome} 
 {clientes->celular} 
 {clientes->email} 
 {clientes->agenda_profissionais_to_string} ");
        $this->fc->setOption('slotTime', "00:30:00");
        $this->fc->setOption('slotDuration', "00:30:00");
        $this->fc->setOption('slotLabelInterval', 30);

        parent::add( $this->fc );
    }

    /**
     * Output events as an json
     */
    public static function getEvents($param=NULL)
    {
        $return = array();
        try
        {
            TTransaction::open('beauty');

            $criteria = new TCriteria(); 

            $criteria->add(new TFilter('horario_inicial', '<=', substr($param['end'], 0, 10).' 23:59:59'));
            $criteria->add(new TFilter('horario_final', '>=', substr($param['start'], 0, 10).' 00:00:00'));

            if(!empty($param['clear_session_filters']))
            {
                TSession::setValue(__CLASS__.'load_filter_profissionais_id', null);
            }

            if(!empty($param['profissional_id'] ?? null))
            {
                TSession::setValue(__CLASS__.'load_filter_profissionais_id', $param['profissional_id'] ?? null);
            }
            $filterVar = TSession::getValue(__CLASS__.'load_filter_profissionais_id');
            if (isset($filterVar) AND ( (is_scalar($filterVar) AND $filterVar !== '') OR (is_array($filterVar) AND (!empty($filterVar)))))
            {
                $criteria->add(new TFilter('profissionais_id', '=', $filterVar)); 
            }

            $events = Agenda::getObjects($criteria);

            if ($events)
            {
                foreach ($events as $event)
                {
                    $event_array = $event->toArray();
                    $event_array['start'] = str_replace( ' ', 'T', $event_array['horario_inicial']);
                    $event_array['end'] = str_replace( ' ', 'T', $event_array['horario_final']);
                    $event_array['id'] = $event->id;
                    $event_array['color'] = $event->render("{cor}");
                    $event_array['title'] = TFullCalendar::renderPopover($event->render("{clientes->nome} |  {clientes->celular} | 
 {profissionais->nome} 
"), $event->render("Cliente:"), $event->render(" {clientes->nome} 
 {clientes->celular} 
 {clientes->email} 
 {clientes->agenda_profissionais_to_string} "));

                    $return[] = $event_array;
                }
            }
            TTransaction::close();
            echo json_encode($return);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    /**
     * Reconfigure the callendar
     */
    public function onReload($param = null)
    {
        if (isset($param['view']))
        {
            $this->fc->setCurrentView($param['view']);
        }

        if (isset($param['date']))
        {
            $this->fc->setCurrentDate($param['date']);
        }
    }

}

