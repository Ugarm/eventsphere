import { useContext } from "react";
import { meetupContext } from "../stores/MeetupProvider";
import { eventContext } from "../stores/EventProvider.tsx";

const useMeetupContext = () => {
  const context = useContext(meetupContext);
  if (context === undefined) {
    throw new Error("useMeetupContext must be used within a MeetupProvider");
  }
  return context;
};

const useEventContext = () => {
  const context = useContext(eventContext);
  if (context === undefined) {
    throw new Error("useEventContext must be used within a EventProvider");
  }
  return context;
};

export { useMeetupContext, useEventContext };
