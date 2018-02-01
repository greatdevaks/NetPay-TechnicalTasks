class CreateTooltip{
			
			constructor(ref_id, new_id, tooltip_val){
				this.ref_id = ref_id;
				this.new_id = new_id;
				this.tooltip_val = tooltip_val;
			}

			setTooltip(){
				document.getElementById(this.ref_id).setAttribute("class", "tooltip " + this.ref_id);
				var spanner = document.createElement("SPAN");
				spanner.setAttribute("id", this.new_id);
				spanner.setAttribute("class", "tooltiptext");
				spanner.innerHTML = this.tooltip_val;
				document.getElementById(this.ref_id).appendChild(spanner);
			}
		}