type meetup = {
  meetup_name: string;
  meetup_description: string;
  meetup_date: Date;
  meetup_city: string;
  meetup_region: string;
  meetup_address: string;
  meetup_gps_coordinates: string;
  meetup_event_type: string;
  max_participants: number;
  user_id?: number;
};

type event = {
  event_name: string;
  event_description: string;
  event_date: Date;
  event_city: string;
  event_region: string;
  event_address: string;
  event_host: string;
  event_attendees: number;
  is_free_event: boolean;
  event_price: number;
  ticket_link: string;
  event_available_tickets: number;
  event_type: string;
  organization_account_id: number;
};

export type { meetup, event };
