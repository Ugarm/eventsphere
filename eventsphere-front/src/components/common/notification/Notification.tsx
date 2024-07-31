/* eslint-disable react-refresh/only-export-components */
import { Toaster, toast } from "sonner";


export const notify = (message: string, type: string) => {
  switch (type) {
    case "success":
      return toast.success(message);
    case "error":
      return toast.error(message);
    case "warning":
      return toast.warning(message);
    default:
      return toast.info(message);
  }
};
const Notification = () => {
  return <Toaster position="bottom-right" expand={false} />;
};

export default Notification;
